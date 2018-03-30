<?php
ini_set('display_errors', 1);
ini_set('max_execution_time', 600);
require_once('app/Mage.php');
$count = 0;
umask(0);
Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
				echo "<table>";
							echo "<tr><td>";
							
                                             //echo 'id'.$_GET['id'];
								
$resource = Mage::getSingleton('core/resource');
$readConnection = $resource->getConnection('core_read');
$id = $_GET['id'];
	$qry1 = "select * from locations where id='$id'";
	$results = $readConnection->fetchAll($qry1);
	$row = $results[0];echo $row['address'];
	$add = $row['address'];
	$town = $row['town'];
	$state = $row['state'];
	$postcode = $row['postcode'];
	$address="$add $town $state $postcode";
	$AdD3 = $address;
										
											//Local//
												$key="AIzaSyCd2jzNEGVt1Y4pU7i4d793cj9PafXcLW8";				
											//Live//
											//$key="ABQIAAAAljeZ0jFCUNG_-xKzK7t0kBRvkLyYf0d4ImdRMLvip-XeY-2IiBT9kuj-J0t3IICgag0rwqMh7WJOvg";
											//echo "<tr><td align='center'><iframe src='http://maps.google.com/?q=$row[postcode]' height='470' scrolling='auto' frameborder='0'></iframe></td></tr>";
											//$address = $_GET['id'];
											//$AdD3=$_GET['id'];
											echo $address;
											Show_map($address,$key,$AdD3);
									
								
								echo "</td></tr>";
								echo "</table>";

function Show_map($addess,$Key,$AdD3)
  {
	?>
	
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    
    <style type="text/css">
    v\:* {
      behavior:url(#default#VML);
    }
    </style>
    
	
    <script src="http://maps.google.com/maps?file=api&amp;v=2.x&amp;key=<?=$Key?>" type="text/javascript"></script>
    <script type="text/javascript">
    //<![CDATA[

    var map = null;
    var geocoder = null;

    function load() {
      if (GBrowserIsCompatible()) {
        map = new GMap2(document.getElementById("map"));
        map.setCenter(new GLatLng(37.4419, -122.1419), 13);
        geocoder = new GClientGeocoder();
      }
    }

    function showAddress(address,AdD) {
      if (geocoder) {
        geocoder.getLatLng(
          address,
          function(point) {
            if (!point) {
              alert(address + " not found");
            } else {
             
	      map.addControl(new GMapTypeControl());
              map.addControl(new GSmallMapControl());
              map.setCenter(point, 13);
              map.setMapType(G_HYBRID_MAP); 
              var marker = new GMarker(point);
              map.addOverlay(marker);
              var v1 = AdD.split(",");
              
              marker.openInfoWindowHtml("<table border=0 cellpadding=0 cellspacing=0 align=left><tr><td><b>Address:</b></td></tr><tr height=10px><td></td></tr><tr><td>" + v1[0] +  "</td></tr><tr><td>" + v1[1] + ",  " + v1[2] + " " + v1[3] + "</td></tr></table>");
            }
          }
        );
      }
    }
    //]]>
    </script>
  </head>

  <body onload="load();showAddress('<?=$addess?>','<?=$AdD3?>');" onunload="GUnload()" >
       <div id="map" style="width: 1000px; height: 570px;border: 1px solid #000000"></div>
   </body>
</html>

	<?php
}
?>
