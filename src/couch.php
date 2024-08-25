
<?php

use Illuminate\Support\Str;
use GuzzleHttp\Client as c2;
use GuzzleHttp\Psr7\Request as r2;

class couch
{

    function database()
    {
        //dd(server_db());
        // $n ama_aplikasi = "siakad_118d3b2e79a1b9e984a96b8e3ec21562";
        //  $nama_aplikasi = "siakad2";
        //$nama_aplikasi = "siakad_3";
        // $db = server_db();
        $nama_aplikasi = env("DB_DATABASE");
        // $nama_aplikasi = "siakad_3";
        return $nama_aplikasi;
    }



    function server()
    {
        $ //db = server_db();
        //$_COOKIE 
        // $server = "46.250.224.31:5984/" . database() . "";
        $server = env("DB_COUCH_HOST ") . ":" . env("DB_COUCH_PORT ") . "/" . database() . "";
        $server = $server . "/" . database() . "";
        return $server;
    }


    function simpan_data($table, $json)
    {
        // dd($json);
        $json["urut"] = urut();
        // dd($json);
        $json = json_encode($json);
        $rand = rand(000000000, 999999999) . date("dmyhis") . rand(000000000, 99999999) . Str::uuid();
        $key = $table . "-" . md5($rand) . "-" . urut() . "-" . date("dmy");

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => '' . server() . '/' . $key . '',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => '{
      "table":"' . $table . '",
      "data" : ' . $json . '
      }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: text/plain'
            ),
        ));

        $response = curl_exec($curl);
        //dd($response);
        curl_close($curl);
        //dd($response);
    }



    function simpan_data_no_urut($table, $json)
    {
        // dd($json);
        //$json["urut"] = urut();
        // dd($json);
        $json = json_encode($json);
        $rand = rand(000000000, 999999999) . date("dmyhis") . rand(000000000, 99999999) . Str::uuid();
        $key = $table . "-" . md5($rand) . "-" . urut() . "-" . date("dmy");

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => '' . server() . '/' . $key . '',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => '{
      "table":"' . $table . '",
      "data" : ' . $json . '
      }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: text/plain'
            ),
        ));

        $response = curl_exec($curl);
        //dd($response);
        curl_close($curl);
        //dd($response);
    }


    function tampil_data($table)
    {
        $curlOptions = [
            CURLOPT_URL => sprintf('%s/_design/%s/_view/%s?include_docs=true&descending=true', server(), $table, $table),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ];

        $curl = curl_init();
        curl_setopt_array($curl, $curlOptions);
        $response = curl_exec($curl);
        curl_close($curl);

        $json = json_decode($response, true);
        $docs = array_map(function ($item) {
            return $item["doc"];
        }, $json["rows"]);

        usort($docs, "xdesc");
        return $docs;
    }

    function tampil_data3($table)
    {
        $curlOptions = [
            CURLOPT_URL => sprintf('%s/_design/%s/_view/%s?include_docs=true&descending=true', server(), $table, $table),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ];

        $curl = curl_init();
        curl_setopt_array($curl, $curlOptions);
        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true)["rows"];
    }



    function tampil_data33($table)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => '' . server() . '/_design/' . $table . '/_view/' . $table . '?include_docs=true&descending=true',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        //echo $response;
        $json = json_decode($response, true);
        $data = $json["rows"];
        //  dd($data);
        return $data;
    }


    function tampil_data_limit($table)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => '' . server() . '/_design/' . $table . '/_view/' . $table . '?include_docs=true&descending=true',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        //echo $response;
        $json = json_decode($response, true);
        $data = $json["rows"];
        foreach ($data as $item) {
            //dd($item);
            $docs[] = $item["doc"];
        }
        usort($docs, "xdesc");
        return $docs;
    }


    function tampil_data_limit2($table, $limit)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => '' . server() . '/_design/' . $table . '/_view/' . $table . '?include_docs=true&descending=true&limit=' . $limit . '',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        //echo $response;
        $json = json_decode($response, true);
        $data = $json["rows"];
        foreach ($data as $item) {
            //dd($item);
            $docs[] = $item["doc"];
        }
        usort($docs, "xdesc");
        return $docs;
    }


    function simpan_data_banyak($table, $json)
    {
        $json = json_encode($json);
        //  dd($json);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => '' . server() . '/_bulk_docs',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
        "docs": ' . $json . '
        }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        // dd($response);
        curl_close($curl);
        // dd($response);
        //echo $response;
    }

    function simpan_data_banyak_cache($table, $json)
    {
        $json = json_encode($json);
        //  dd($json);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => '' . server() . '/_bulk_docs',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
        "docs": ' . $json . '
        }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        //dd($response);

        curl_close($curl);
        // dd($response);
        //echo $response;
    }


    function reset_data($table)
    {
        $tampil = tampil_data($table);
        foreach ($tampil as $item) {
            $x["_id"] = $item["_id"];
            $x["_rev"] = $item["_rev"];
            $x["_deleted"] = true;
            $data[] = $x;
        }

        //   dd($data);
        $json = json_encode($data);
        //  dd($json);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => '' . server() . '/_bulk_docs',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
          "docs": ' . $json . '
          }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // dd($response);
        //echo $response;

    }


    function delete_data($id, $rev)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => '' . server() . '/' . $id . '?rev=' . $rev . '',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        //echo $response;
    }





    function cari_id($id)
    {
        error_reporting(0);
        $client = new c2(); // Reuse existing client from query_umum

        $request = new r2('GET', server() . '/' . $id);
        $response = $client->send($request); // Use existing client for a cleaner approach

        $data = json_decode($response->getBody(), true);


        return $data["data"];
    }


    function simpan_edit($tabel, $json, $id, $rev)
    {
        $json = json_encode($json);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => '' . server() . '/' . $id . '',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => '{
            "_rev": "' . $rev . '" ,
            "table":"' . $tabel . '",
            "data" : ' . $json . '
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: text/plain'
            ),
        ));

        $response = curl_exec($curl);
        //dd($response);
        curl_close($curl);
        //dd($response);
    }


    function tampil_relasi1($table, $key, $filter)
    {
        error_reporting(0);
        $curl = curl_init();


        if (empty($key)) {
            if (empty($filter)) {
                $alamat = '' . server() . '/_design/' . $table . '/_view/' . $table . '_relasi?include_docs=true';
            } else {
                $alamat = '' . server() . '/_design/' . $table . '/_view/' . $table . '_relasi_filter?include_docs=true&key="' . $filter . '"';
            }
        } else {
            $alamat = '' . server() . '/_design/' . $table . '/_view/' . $table . '_relasi?include_docs=true&key="' . $key . '"';
        }


        curl_setopt_array($curl, array(
            CURLOPT_URL => $alamat,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $json = json_decode($response, true);
        $rows = $json["rows"];
        foreach ($rows as $item) {
            $x["value"] = $item["value"]["data"];
            $x["doc"] = $item["doc"]["data"];
            $all[] = $x;
        }

        //dd($x);
        usort($all, 'desc');
        return $all;
    }


    function tampil_relasi1_2($table, $key, $filter)
    {
        error_reporting(0);
        $curl = curl_init();


        if (empty($key)) {
            if (empty($filter)) {
                $alamat = '' . server() . '/_design/' . $table . '/_view/' . $table . '_relasi?include_docs=true';
            } else {
                $alamat = '' . server() . '/_design/' . $table . '/_view/' . $table . '_relasi_filter?include_docs=true&key="' . $filter . '"';
            }
        } else {
            $alamat = '' . server() . '/_design/' . $table . '/_view/' . $table . '_relasi?include_docs=true&key="' . $key . '"';
        }


        curl_setopt_array($curl, array(
            CURLOPT_URL => $alamat,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $json = json_decode($response, true);
        $rows = $json["rows"];

        return $rows;
    }

    function urut()
    {
        error_reporting(0);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => '' . server() . '/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        //echo $response;
        $json = json_decode($response, true);
        $del = $json["doc_del_count"];
        $count  = $json["doc_count"];
        $next = $del + $count + 1;
        //dd($next);
        return $next;
    }

    function cari_view_key($table, $key)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => '' . server() . '/_design/' . $table . '/_view/' . $table . '?include_docs=true&key=%22' . $key . '%22',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $json = json_decode($response, true);
        $data = $json["rows"][0]["doc"]["data"];
        return $data;
    }


    function desc($a, $b)
    {
        //untuk view
        return $b['value']['data']['urut'] - $a['value']['data']['urut'];
    }

    function asc($a, $b)
    {
        return $a['value']['data']['urut'] - $b['value']['data']['urut'];
    }


    function xdesc($a, $b)
    {
        //untuk tampil_data
        return $b['data']['urut'] - $a['data']['urut'];
    }

    function xasc($a, $b)
    {
        return $a['data']['urut'] - $b['data']['urut'];
    }

    function last_find_data($table)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => '' . server() . '/_find',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
              "selector": {
                "table": "' . $table . '"
                },
                "sort": [
                  {
                    "data.urut": "desc"
                    }
                    ],
                    "limit": 1
                    }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $josn = json_decode($response, true);
        // dd($josn);
        return $josn;
    }



    use GuzzleHttp\Client;
    use GuzzleHttp\Psr7\Request;


    function query($table, $field, $urut, $limit)
    {
        $field = json_encode($field);
        // dd($field);
        $client = new Client();
        $headers = [
            'Content-Type' => 'application/json'
        ];
        $body = '{
                    "selector": {
                      "table": "' . $table . '",
                      "data": ' . $field . '
                    },
                    "sort": [
                      {
                        "data.urut": "' . $urut . '"
                      }
                    ],
                    "limit": ' . $limit . ',
                    "skip": 0,
                    "execution_stats": true
                  }';
        //dd(server());
        $request = new Request('POST', '' . server() . '/_find', $headers, $body);
        $res = $client->sendAsync($request)->wait();
        $json =  $res->getBody();
        $json = json_decode($json, true);
        $data = $json["docs"];
        // dd($res);

        return $data;
    }

    function query2($table, $field, $limit)
    {
        $client = new Client(); // Reuse existing client from query_umum (assumed)
        $headers = ['Content-Type' => 'application/json'];

        $body = json_encode([
            "selector" => [
                "table" => $table,
                "data" => $field,
            ],
            "limit" => $limit,
            "skip" => 0, // Consider removing if not used
            "execution_stats" => true, // Consider removing if not used
        ]);

        $request = new Request('POST', server() . '/_find', $headers, $body);
        $response = $client->send($request); // Use synchronous request for simpler code

        $data = json_decode($response->getBody(), true)["docs"];

        return $data;
    }


    function query_login($table, $field, $limit)
    {
        $client = new Client(); // Reuse existing client from query_umum (assumed)
        $headers = ['Content-Type' => 'application/json'];

        $body = json_encode([
            "selector" => [
                "table" => $table,
                "data" => $field,
            ],
            "limit" => $limit,
            "skip" => 0, // Consider removing if not used
            "execution_stats" => true, // Consider removing if not used
        ]);

        $request = new Request('POST', server() . '/_find', $headers, $body);
        $response = $client->send($request); // Use synchronous request for simpler code

        $data = json_decode($response->getBody(), true)["docs"];

        return $data;
    }



    function query_umum($q)
    {
        // $field = json_encode($field);
        //dd($field);
        $client = new Client();
        $headers = [
            'Content-Type' => 'application/json'
        ];
        $body = $q;
        //dd(server());
        $request = new Request('POST', '' . server() . '/_find', $headers, $body);
        $res = $client->sendAsync($request)->wait();
        $json =  $res->getBody();
        $json = json_decode($json, true);
        $data = $json["docs"];
        // dd($data);

        return $data;
    }


    function notif_ke($notif, $ke)
    {
        echo "<script>alert('" . $notif . "')</script>";
        echo "<script>window.location='" . url('/' . $ke . '') . "'</script>";
    }

    function ke($ke)
    {
        echo "<script>window.location='" . url('/' . $ke . '') . "'</script>";
    }


    function cari_id2($id)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => '' . server() . '/' . $id . '',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $json = json_decode($response, true);
        // $data = $json["data"];
        // dd($data);\
        return $json;
    }

    function list_view()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => '' . server() . '/_design_docs',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $json = json_decode($response, true);
        // $data = $json["data"];
        // dd($data);\
        $json2 = $json["rows"];
        foreach ($json2 as $item) {
            $key[] = $item["key"];
        }

        foreach ($key as $item2) {
            $key2[] = str_replace("_design/", "", $item2);
        }

        //dd($key2);
        return $key2;
    }



    function simpan_data2($table, $json)
    {
        // dd($json);
        $json["urut"] = "";
        // dd($json);
        $json = json_encode($json);
        $rand = rand(000000000, 999999999) . date("dmyhis") . rand(000000000, 99999999) . Str::uuid();
        $key = $table . "-" . md5($rand) . "-" . urut() . "-" . date("dmy");

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => '' . server() . '/' . $key . '',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => '{
      "table":"' . $table . '",
      "data" : ' . $json . '
      }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: text/plain'
            ),
        ));

        $response = curl_exec($curl);
        //dd($response);
        curl_close($curl);
        //dd($response);
    }






    function tampil_data_satu($table)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => '' . server() . '/_design/' . $table . '/_view/' . $table . '?include_docs=true&descending=true',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        //echo $response;
        $json = json_decode($response, true);
        $data = $json["rows"];
        foreach ($data as $item) {
            //dd($item);
            $docs[] = $item["doc"];
        }
        usort($docs, "xdesc");
        return $docs;
    }
}
