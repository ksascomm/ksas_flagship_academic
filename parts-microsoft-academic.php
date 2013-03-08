<?php $author_id = get_post_meta($post->ID, 'ecpt_microsoft_id', true);
		$api_key = '590653d5-7996-40b8-ad51-34426603139c';
	require (TEMPLATEPATH . '/assets/functions/Resty.php'); 
		$http = new Resty();
		$http->debug(true);
        $http->setBaseUrl("http://academic.research.microsoft.com/json.svc");
          $queryData = array(
            "AppID" => $api_key,
            "AuthorId" => $author_id,
            "ResultObjects" => "publication", 
            "PublicationContent" => "title",
            "ResultObjects" => "publication", 
            "OrderType" => "year", 
            "StartIdx" => "1",
            "EndInx" => "25", 
            );
        $response = $http->get("/search", $queryData);
        $response->parse_body(true);

		$microsoft_pubs = $response['d']['Publication'];
		foreach($microsoft_pubs['Result'] as $microsoft_pub) { 

?>	

<p class="bold"><a href="http://academic.research.microsoft.com/Publication/<?php echo $microsoft_pub['ID'] ?>"><?php echo $microsoft_pub['Title'] ?></a><br>
<?php echo $microsoft_pub['Year'] ?> in <?php echo $microsoft_pub['Journal']['FullName'] ?></p>

<?php } ?>						