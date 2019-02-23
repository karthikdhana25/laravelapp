<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('article.index');


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function getarticle(Request $request){

        $input = request()->all();

        $name = $input['name']; 

        $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://newsapi.org/v2/everything?q=".$name."&from=2019-02-20&to=2019-02-23&sortBy=popularity&apiKey=fcbd8abeaea54bb1953217da9403fdd9",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_TIMEOUT => 30000,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        // Set Here Your Requesred Headers
                        'Content-Type: application/json',
                    ),
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);

                $result = json_decode($response);

                $articles=$result->articles;

                // print_r($articles); die;
                ob_start();

                    foreach ($articles as $key => $value) { ?>

                    <div>
                        
                      <h2><a href="<?php echo $value->url; ?>" target="_blank"> <?php echo $value->title; ?></a></h2>
                      <p><label>Author: </label> <?php echo $value->author; ?></p>
                      <?php
                      if($value->urlToImage){
                        ?>
                              <p><img src="<?php echo $value->urlToImage; ?>" style="width: 150px;height: 150px;"> </p>

                      <?php } ?>

                      <p><label>Description: </label> <?php echo $value->description; ?></p>
                      <p><label>Content: </label> <?php echo $value->content; ?></p>
                    </div>
                    <?php } 

                $return['data'] = ob_get_contents();
                ob_end_clean();

                
                echo json_encode($return);

    }

    public function getarticlebydomain(Request $request){

        $input = request()->all();

        // echo $input->date;

        $dates = explode("-", $input['date']);

        $originalDate = $dates[0];
        $from = date("Y-m-d", strtotime($originalDate));

        $originalDate = $dates[1];
        $to = date("Y-m-d", strtotime($originalDate));

        // print_r($newDate); die;

        $domain = $input['domain']; 

        $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://newsapi.org/v2/everything?domains=".$domain."&from=".$from."&to=".$to."&apiKey=fcbd8abeaea54bb1953217da9403fdd9",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_TIMEOUT => 30000,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        // Set Here Your Requesred Headers
                        'Content-Type: application/json',
                    ),
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);

                $result = json_decode($response);

                $articles=$result->articles;

                // print_r($result); die;
                ob_start();

                    ?>
                    <div id="listId">
                    <ul class="list">

                    <?php foreach ($articles as $key => $value) { ?>
                    <li>
                    <div>
                        
                      <h2><a href="<?php echo $value->url; ?>" target="_blank"> <?php echo $value->title; ?></a></h2>
                      <p><label>Author: </label> <?php echo $value->author; ?></p>
                      <p><label>published At: </label> <?php echo $value->publishedAt; ?></p>
                      <p><label>Domain: </label> <?php echo $value->source->name; ?></p>
                      <?php
                      if($value->urlToImage){
                        ?>
                              <p><img src="<?php echo $value->urlToImage; ?>" style="width: 150px;height: 150px;"> </p>

                      <?php } ?>

                      <p><label>Description: </label> <?php echo $value->description; ?></p>
                      <p><label>Content: </label> <?php echo $value->content; ?></p>
                    </div>
                    </li>
                    <?php } ?>
                    </ul>
                    <ul class="pagination"></ul>
                    <script>
                      var options = {
                        valueNames: [ 'name', 'category' ],
                        page: 5,
                        plugins: [
                          ListPagination({})
                        ]
                      };

                      var listObj = new List('listId', options);
                    </script>
    <?php
                $return['data'] = ob_get_contents();
                ob_end_clean();

                
                echo json_encode($return);

    }

    
}
