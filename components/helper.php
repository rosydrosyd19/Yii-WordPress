<?php

namespace app\components;

use Yii;
use yii\db\Expression;
use yii\web\UploadedFile;
use yii\HieuLe\WordpressXmlrpcClient;
use yii\data\ArrayDataProvider; //** Tambahkan ArrayDataProvider */
use yii\helpers\ArrayHelper;
use yii\widgets\ListView;

 class helper
{

    public static function domExample($data)
    {
        $result=[];
		$data = [
			'0' => 'http://kominfo.magetan.go.id/wp/siaran-pers/',
			'1' => 'http://kominfo.magetan.go.id/wp/sorotan-media/'
		];

		foreach ($data as $key => $value) {
			$html = Scrapers::file_get_contents_curl($value);

			$doc = new \DOMDocument();
			@$doc->loadHTML($html);
			$xpath = new \DOMXpath($doc);

			// Title....
			$title  = $xpath->query('//div[contains(@class, "layer-wrapper")]');
			$title  = $xpath->query('//div[contains(@class, "title")]');
			for ($i=0; $i < $title->length; $i++) {
				$rs = $title->item($i);
				$tmp_data['judul'][] = trim($rs->nodeValue);
			}

			// Href....
			$href  = $xpath->query('//div[contains(@class, "layer-wrapper")]');
			$href  = $xpath->query('//div[contains(@class, "title")]/a/@href');
			for ($i=0; $i < $href->length; $i++) {
				$rs = $href->item($i);
				$tmp_data['link_url'][] = trim($rs->value);
			}

			// Thumbnail...
			$thumb  = $xpath->query('//div[contains(@class, "layer-wrapper")]');
			$thumb  = $xpath->query('//div[contains(@class, "thumb")]/img/@src');
			for ($i=0; $i < $thumb->length; $i++) {
				$rs = $thumb->item($i);
				$tmp_data['thumbnail'][] = trim($rs->value);
			}

			// Deskripsi...
			$deskripsi  = $xpath->query('//div[contains(@class, "layer-wrapper")]');
			$deskripsi  = $xpath->query('//div[contains(@class, "excerpt")]');
			for ($i=0; $i < $deskripsi->length; $i++) {
				$rs = $deskripsi->item($i);
				$tmp_data['deskripsi'][] = trim($rs->nodeValue);
			}

			$count  = $xpath->query('//div[contains(@class, "layer-wrapper")]');
			$count  = $xpath->query('//div[contains(@class, "excerpt")]');
			for ($i=0; $i < $count->length; $i++) {
				$tmp_data['omail_id'][] = '16';
			}

			for ($i=0; $i < $count->length; $i++) {
				$tmp_data['created_date'][] = date('Y-m-d H:i:s');
			}

		}

		foreach ($tmp_data['judul'] as $key => $value) {
			$result[$key]['judul'] = $tmp_data['judul'][$key];
			$result[$key]['link_url'] = $tmp_data['link_url'][$key];
			$result[$key]['thumbnail'] = $tmp_data['thumbnail'][$key];
			$result[$key]['deskripsi'] = $tmp_data['deskripsi'][$key];
			$result[$key]['omail_id'] = $tmp_data['omail_id'][$key];
			$result[$key]['created_date'] = $tmp_data['created_date'][$key];
		}
}

    // public static function getEmbetLink($data)
    public static function getSrcImage($data)
    {
        // foreach ($data as $key => $value) {
        //     // echo $value['post_content'] . '<br>';
        //     $content = $value['post_content'];
        //     // we need a expression to match things
        //     $regex = '/src="([^"]*)"/';
        //     // $regex = '/<div class="wp-block-embed__wrapper"([^"]*)<\/div>/';
        //     // we want all matches
        //     preg_match_all( $regex, $content, $matches );
        //     // reversing the matches array
        //     $matches = array_reverse($matches);
        //     foreach ($matches as $key2 => $value2) {
        //         if (isset($value2[0])) {
        //             $data[$key]['image_url'] = $value2[0];
        //         }
        //     }

            //!!
            //** Menampilkan data gambar dari array */
            foreach ($data as $key => $value) {
            $content = $value['post_content'];
            $regex = '/src="([^"]*)"/';
            preg_match_all( $regex, $content, $matches );
            $matches = array_reverse($matches);
            // print_r($matches);
            // exit;
            if ($matches[0] == $regex) {
                $matches[0] = array_reverse($matches);
                foreach ($matches as $key2 => $value2) {
                    if (isset($value2[0])) {
                        $data[$key]['image_url'] = isset($value2[0]) ? $value2[0] : $value[1];
                    }
                }
            }else {
                $matches = array_reverse($matches);
                foreach ($matches as $key2 => $value2) {
                    if (isset($value2[0])) {
                        $data[$key]['image_url'] = isset($value2[0]) ? $value2[0] : $value[1];;
                    }
                }
            }
            //!!

            // print_r($matches);
            // exit;

            // echo '<pre>';
            // we've reversed the array, so index 0 returns the result
            // print_r($matches[0]);
            // echo '</pre>';
        }
        // foreach ($matches as $key => $value) {
        //     if ($value) {
        //         $data[$key]['image_url'] = $value;
        //     }
        // }
        return $data;
    }

    // public static function getSrcImage($data)
    public static function getEmbetLink($data)
    {
        // return $data;
        // echo "<pre>";
        // print_r($data);
        // exit;

        // foreach ($data as $key => $value) {
        //     // echo $value['post_content'] . '<br>';
        //     $content = $value['post_content'];
        //     // we need a expression to match things
        //     // $regex = '/src="([^"]*)"/';
        //     $regex = '/<div class="wp-block-embed__wrapper">([^"]*)<\/div>/';
        //     // we want all matches
        //     preg_match_all( $regex, $content, $matches );
        //     // reversing the matches array
        //     $matches[0] = array_reverse($matches);
        //     // $matches = array_reverse($matches);
        //     foreach ($matches as $key2 => $value2) {
        //         if (isset($value2[0])) {
        //             $data[$key]['image_url'] = $value2[0];
        //         }
        //     }
        //     // echo '<pre>';
        //     // we've reversed the array, so index 0 returns the result
        //     // print_r($matches[0]);
        //     // echo '</pre>';
        // }
        
        //!!
        foreach ($data as $key => $value) {
            $content = $value['post_content'];
            $regex = '/<div class="wp-block-embed__wrapper"([^"]*)<\/div>/';
            preg_match_all( $regex, $content, $matches );
            $matches = array_reverse($matches);
                if ($matches[0] == $regex ) {
                    $matches[0] = array_reverse($matches);
                    foreach ($matches as $key2 => $value2) {
                        if (isset($value2[0])) {
                            $data[$key]['image_url'] = $value2[0];
                        }
                    }
                } else {
                    $matches = array_reverse($matches);
                    foreach ($matches as $key2 => $value2) {
                        if (isset($value2[0])) {
                            $data[$key]['image_url'] = $value2[0];
                        }
                    }
                }
        }
        //!!
        // foreach ($matches as $key => $value) {
        //     if ($value) {
        //         $data[$key]['image_url'] = $value;
        //     }
        // }
        return self::getSrcImage($data);
        // return self::getEmbetLink($data);
        // print_r(self::getEmbetLink($data));
    }

    public static function wpCall()
    {
        // // ** Membuat postingan baru */
        // $postID = Yii::$app->site->newPost('New_post', 'Hello world!');
        // return $postID;
        // // ** */

        //** Memanggil postingan yang telah ada di wordpress */
        $data = Yii::$app->site->getPosts([
            //** Mengambil data pada wordpress dengan status publis */
            'post_status' => 'publish'
            //** Mendeklarasikan nama atribut */
            ],[ 'post_id',
            'guid' => 'link',
            'post_title',
            'post_content'
            ]);
            $tmp=[];
            foreach ($data as $key => $value) {
                $tmp[]=[
                    'post_id' => $value['post_id'],
                    'link' => $value['link'],
                    'post_title' => $value['post_title'],
                    'image_url' => null,
                    'post_content' => $value['post_content']
                ];
            }
            // echo '<pre/>';
            // print_r($tmp);
            // exit;
            // $data['img_urtl'];
            $data = self::getEmbetLink($tmp);
            // $data = self::domExample($data);
            // echo '<pre>';
            // print_r($data);
            // exit;
        //** Mengolah atribut yang akan di tampilkan */
        $provider = new ArrayDataProvider([
            'allModels' => $data,
            'pagination' => [
                //** Jumlah konten yang akan di muat dalam 1 page */
                'pageSize' => 1,
            ],
            'sort' => [
                //** Mendeklarasikan nama atrribut yang akan di tampilkan */
                'attributes' => [
                'post_id',
                'link',
                'post_title',
                'post_content',
                'image_url',
            ],],
        ]);

        $model = $provider->getModels();
        return $provider;
        //** */

    }
}