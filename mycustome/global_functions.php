<?php


   function resizeImage($source, $destination, $thumbW, $thumbH, $imageType) 
    {
        list($width, $height, $type, $attr) = getimagesize($source);
        $x = 0;
        $y = 0;
      /*  if ($width*$thumbH>$height*$thumbW) {
            $x = ceil(($width - $height*$thumbW/$thumbH)/2);
            $width = $height*$thumbW/$thumbH;
        } else {
            $y = ceil(($height - $width*$thumbH/$thumbW)/2);
            $height = $width*$thumbH/$thumbW;
        } */
      
        list($widthThmbnl,$heightThmbnl)=getimagesize($source);
        
        
                  // if($widthThmbnl>=800)
                    //          $thumbW=800;
                            // else
                            //    $thumbW=$widthThmbnl;
                          // $big_width=450;
                             $thum_naail_file_name=$convert_new_file_name;
                          //   $big_file_name="sites/default/files/$folderEntry";        
                             $thumbH=round(($heightThmbnl*$thumbW)/$widthThmbnl);
               
            
        $newImage = imagecreatetruecolor($thumbW, $thumbH) or die ('Can not use GD');
        
        
      
                             
                            // echo "<br> new height is ".$thumbH;
                             //exit();
    
        /*
        if ($extension=='jpg' || $extension=='jpeg') {
            $image = imagecreatefromjpeg($source);
        } else if ($extension=='gif') {
            $image = imagecreatefromgif($source);
        } else if ($extension=='png') {
            $image = imagecreatefrompng($source);
        } 
        */
        switch($imageType) 
        {
            case "image/gif":
                $image = imagecreatefromgif($source);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                $image = imagecreatefromjpeg($source);
                break;
            case "image/png":
            case "image/x-png":
                $image = imagecreatefrompng($source);
                break;
        }
    
        if (!@imagecopyresampled($newImage, $image, 0, 0, 0, 0, $thumbW, $thumbH, $widthThmbnl, $heightThmbnl)) {
            return false;
        } else {
            imagejpeg($newImage, $destination,100);
            imagedestroy($image);
            return true;
        }
    }
  
   function upload_file_on_server($file_variable_name,$folder_name_upload="",$file_typesArray="",$file_size="",$new_file_name="")
     {
     // global $base_path;  
        //uploading the file on server
        $file_type_size_conditions="";
        // $new_file_name=$_FILES[$file_variable_name]["name"];
          
    
                    if ($_FILES[$file_variable_name]["error"] > 0)
                      {
                         echo "Error: " . $_FILES[$file_variable_name]["error"] . "<br />";
                         exit();
                      }
                    else
                      {
                        //application/csv
                      //application/msword
                      //application/vnd.openxmlformats-officedocument.wordprocessingml.document
                      list($width, $height, $type, $attr)=getimagesize($_FILES[$file_variable_name]["tmp_name"]);
                 
                        if ((($_FILES[$file_variable_name]["type"] == "image/gif")
                                    || ($_FILES[$file_variable_name]["type"] == "image/jpeg")
                                    || ($_FILES[$file_variable_name]["type"] == "application/vnd.ms-excel")
                                      || ($_FILES[$file_variable_name]["type"] == "text/csv")
                                      || ($_FILES[$file_variable_name]["type"] == "application/csv")                                
                                    || ($_FILES[$file_variable_name]["type"] == "image/pjpeg")
                                     || ($_FILES[$file_variable_name]["type"] == "application/msword")
                                    
                                    || ($_FILES[$file_variable_name]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
                                          || ($_FILES[$file_variable_name]["type"] == "application/pdf")
                                    || ($_FILES[$file_variable_name]["type"] == "image/png"))
                                   )                                
                                      {
                                          if ($_FILES[$file_variable_name]["error"] > 0)
                                            {
                                                 echo "Error: " . $_FILES[$file_variable_name]["error"] . "<br />";
                                            }
                                          else
                                            {
                                                    // echo "<br> uploading";
                                                    
        
                                                      move_uploaded_file($_FILES[$file_variable_name]["tmp_name"],
                                                        $folder_name_upload.$new_file_name);
                                                      
                                                   // echo    $_SERVER["DOCUMENT_ROOT"].$base_path."sites/default/files/$folder_name_upload" . $new_file_name;
                                                 // exit();
    
                                                   return $new_file_name;
                                                                                      
                                            }
                                      }
                                    else
                                      {
                                                  return false;
                                      }
                          
                          
                      }
                  
        
        
     }
     
     
       function upload_bulk_file_on_server($file_variable_name,$folder_name_upload="",$file_typesArray="",$file_size="",$new_file_name="")
     {
     // global $base_path;  
        //uploading the file on server
        $file_type_size_conditions="";
        // $new_file_name=$_FILES[$file_variable_name]["name"];
        $productFileNameArray=array();
        foreach($_FILES[$file_variable_name]["name"] as $pro_id => $imageNameInfoArray)
        {
            foreach($imageNameInfoArray as $img_id => $imageName)
            {
                if(!empty($imageName))
                {
                    
                    
                    if ((($_FILES[$file_variable_name]["type"][$pro_id][$img_id] == "image/gif")
                                    || ($_FILES[$file_variable_name]["type"][$pro_id][$img_id] == "image/jpeg")
                                    || ($_FILES[$file_variable_name]["type"][$pro_id][$img_id] == "application/vnd.ms-excel")
                                      || ($_FILES[$file_variable_name]["type"][$pro_id][$img_id] == "text/csv")
                                      || ($_FILES[$file_variable_name]["type"][$pro_id][$img_id] == "application/csv")                                
                                    || ($_FILES[$file_variable_name]["type"][$pro_id][$img_id] == "image/pjpeg")
                                    || ($_FILES[$file_variable_name]["type"][$pro_id][$img_id] == "image/png"))
                                   )                                
                                      {
                                        
                                        
                                        if ($_FILES[$file_variable_name]["error"][$pro_id][$img_id] > 0)
                                            {
                                                 echo "Error: " . $_FILES[$file_variable_name]["error"][$pro_id][$img_id] . "<br />";
                                            }
                                          else
                                            {
                                               // echo '<br> we are in this'.$folder_name_upload.$new_file_name;
                                                    // echo "<br> uploading";
                                                       $ext = pathinfo($imageName, PATHINFO_EXTENSION);
                                                       $new_file_name=strtolower($this->random_string().".".$ext);
                                                      move_uploaded_file($_FILES[$file_variable_name]["tmp_name"][$pro_id][$img_id],
                                                        $folder_name_upload.$new_file_name);
                                                      
                                                   // echo    $_SERVER["DOCUMENT_ROOT"].$base_path."sites/default/files/$folder_name_upload" . $new_file_name;
                                                 // exit();
                                                       $productFileNameArray[$pro_id][$img_id]=$new_file_name;
                                                  // return $new_file_name;
                                                                                      
                                            }
                                        
                                        
                                      }
                    
                    
                }
                
            }  // image loop
            
        } //product loop
    
                   
         return $productFileNameArray;          
        
        
     }
     function unlink_file($table_name,$field_array=array(),$upload_folder="") 
     {
        $index_name=$field_array["index_name"];
        $index_value=$field_array["index_value"];
        $file_field=$field_array["file_field"];
        
       $query="select  `$file_field` from  $table_name  where `$index_name`='$index_value'";
        $qrun=mysql_query($query);
        $row=mysql_fetch_array($qrun);
        $file_path=$upload_folder."/".$row[$file_field];
        if(file_exists($file_path))
          unlink($file_path);
        
     }
     function send_email($mailto,$mailtoname,$subjectline="",$content_html="",$from="",$reply_to="")
     {
            //$mailto=$emiail_id;
           // $mailtoname=$fname." ".$lname;
            
           // $subjectline = $subject;
            
            $to='To: '.$mailtoname.' <'.$mailto.'>' . "\r\n";
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= "From: ".$mailtoname." <" . strip_tags($from) .'>'. "\r\n";
            $headers .= "Reply-To: ".$reply_to. "\r\n".'X-Mailer: PHP/' . phpversion();
            @mail($to, $subjectline, $content_html, $headers);            
     }
     
     function sanitize($field="")
     {
         $field=trim($field);
         $field=urlencode($field);
         return $field;
     }
     
     function desanitize($field="")
     {
         $field=stripslashes($field);
         $field=str_replace("``",'"',$field);
         $field=str_replace("`","'",$field);
         $field=urldecode($field);
         
         return $field;  
        
     }
     
       function random_string()
        {
            $character_set_array = array();
            $character_set_array[] = array('count' => 6, 'characters' => 'abcdefghijklmnopqrstuvwxyz');
            $character_set_array[] = array('count' => 2, 'characters' => '0123456789');
            //$character_set_array[] = array('count' => 1, 'characters' => '!@#$+-*&?:');
            $temp_array = array();
            foreach ($character_set_array as $character_set) {
                for ($i = 0; $i < $character_set['count']; $i++) {
                    $temp_array[] = $character_set['characters'][rand(0, strlen($character_set['characters']) - 1)];
                }
            }
            shuffle($temp_array);
            return implode('', $temp_array);
        }
        
        function get_user_friendlyURL($url_str)
        {
            $updated_new_url=strtolower($url_str);
              $updated_new_url=str_replace("/","-",$updated_new_url);
              $updated_new_url=str_replace("&","",$updated_new_url);
            $urlStringArray=explode(" ",$updated_new_url);
            $updated_new_url= implode("-",$urlStringArray);
          // $updated_new_url= str_replace("&","-",$updated_new_url);
            
            return $updated_new_url;
            
        }
        function get_MachineName($url_str)
        {
             $updated_new_url=strtolower($url_str);
              $updated_new_url=str_replace("/","-",$updated_new_url);
              $updated_new_url=str_replace("&","",$updated_new_url);
            $urlStringArray=explode(" ",$updated_new_url);
            $updated_new_url= implode("-",$urlStringArray);
          // $updated_new_url= str_replace("&","-",$updated_new_url);
            
            return $updated_new_url;
            
        }
        
        function getprintEditor()
        {
            $DOMAIN="http://".$_SERVER['SERVER_NAME'];
            global $base_path;
            $module_path=drupal_get_path("module","staticpages");
            global $base_url;
            $theme_path=$base_url."/".drupal_get_path("theme","teatemp");
            $printEditorHTML;
            
            $printEditorHTML='
                            <script type="text/javascript" src="'.$base_path.$module_path.'/js/tiny_mce/tiny_mce.js"></script>
        <script type="text/javascript"> 
        tinyMCE.init({
        		        // General options
        			        mode : "textareas",
        			        theme : "advanced",
        			        plugins : "images,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
        		            editor_selector:"mceEditor",
        		        // Theme options
        			        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
        			        theme_advanced_buttons2 : "images,cut,copy,paste,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        			        theme_advanced_toolbar_location : "top",
        			        theme_advanced_toolbar_align : "left",
        			        theme_advanced_statusbar_location : "bottom",
        			        theme_advanced_resizing : true,
        		
        		        // Skin options
        			        skin : "o2k7",
        			        skin_variant : "silver",
        			        url:"hhhhhhhh", 
        		        // Example content CSS (should be your site CSS)
        		        //	content_css : "'.$theme_path.'/css/style.css",
        		
        		        // Drop lists for link/image/media/template dialogs
        			        document_base_url : "'.$DOMAIN.'",
        			        relative_urls : false,
        			        remove_script_host : false,
        		        // Replace values for the template plugin
        			        template_replace_values : {
        			                                   username : "Some User",
        			                				   staffid : "991234"
        			                                  },
        			        file_browser_callback : "myFileBrowser"
                    	            
                   });
          
          
            function myFileBrowser (field_name, url, type, win) 
                            {
                            
                            //	field_name="description2";
                            
                            //	url="http://localhost/our_tools/php_part/tinymice/js/tiny_mce/plugins/images/images.htm"
                            //	url="http://localhost/our_tools/php_part/tinymice2/js/tiny_mce/plugins/filemanager/index.php"
                            //	url="http://localhost/our_tools/php_part/tinymice2/js/tiny_mce/plugins/pdw_file_browser/index.php?editor=tinymce"
                            url="'.$base_url.'/pdw_file_browser/index.php?editor=tinymce";
                                //alert("Field_Name: " + field_name + "nURL: " + url + "nType: " + type + "nWin: " + win); // debug/testing
                                
                                
                                    
                                
                                var ret_val=tinyMCE.activeEditor.windowManager.open({
                                    file : url,
                                    title : "My File Browser",
                                    width : 820,  // Your dimensions may differ - toy around with them!
                                    height : 600,
                                    resizable : "yes",
                                    inline : "yes",  // This parameter only has an effect if you use the inlinepopups plugin!
                                    close_previous : "no"
                                }, {
                                    window : win,
                                    input : field_name,
                                     editor_id : tinyMCE.selectedInstance.editorId
                            
                                });
                                
                                return true;
                              }
                              
                 </script>                      
                             ';
            
            return $printEditorHTML;
        }
        
         function get_db_format($date,$delimited)
         {
            $date_array=split($delimited,$date);
            $convert_date=$date_array[2].$delimited.$date_array[0].$delimited.$date_array[1];
            return $convert_date;
         }
         function get_view_format($date,$delimited,$conver_delemiter)
         {
            $date_array=split($delimited,$date);
            $convert_date=$date_array[1].$conver_delemiter.$date_array[2].$conver_delemiter.$date_array[0];
            return $convert_date;    
         }
         
         function readCSV($csvFile)
         {
        	$file_handle = fopen($csvFile, 'r');
        	while (!feof($file_handle) ) {
        		$line_of_text[] = fgetcsv($file_handle, 1024);
        	}
        	fclose($file_handle);
        	return $line_of_text;
         }
         
         function GetImageInfo($path,$image_name,$type="path")
         {
            global $base_path,$base_url;
            $slider_abs_path=$_SERVER["DOCUMENT_ROOT"].$base_path.$path.$image_name;
            
                   $img_str="";
                   if(!empty($slider_abs_path)&&!is_dir($slider_abs_path))
                   {
                     //$img_str=$base_url."/sites/default/files/staticimages/".$pageDataArray["slider_image1"];
                     $image_name=str_replace(" ","%20",$image_name);
                     if($type=="path")
                       $img_str=$base_url.$path.$image_name;
                     else
                       $img_str='<img src="'.$base_url.$path.$image_name.'" alt="" class="slide-bg-image" />';
                   }
                   
            return $img_str;       
         }
         
         
         
function array2csvNew(array &$array)
{
	if (count($array) == 0) {
		return null;
	}
	ob_start();
	$df = fopen("php://output", 'w');
	fputcsv($df, array_keys(reset($array)));
	foreach ($array as $row) {
		fputcsv($df, $row);
	}
	fclose($df);
	return ob_get_clean();
}

function download_send_headers($filename) 
{
	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Content-Type: application/force-download");
	header("Content-Type: application/octet-stream");
	header("Content-Type: application/download");
	header("Content-Disposition: attachment;filename={$filename}");
	header("Content-Transfer-Encoding: binary");
    
    //download_send_headers("data_export_" . date("Y-m-d") . ".csv");
//$array=get_customer_data();
//echo array2csv($array);
}

function get_customer_data()
{
	$custQuery="SELECT products.id,products.modelno, products.name,products.title,products.sku ,
products_pdfs.title AS document_title,CONCAT(products_pdfs.product_pdfs_path,products_pdfs.product_pdfs) AS document_root
FROM products_pdfs
INNER JOIN products ON products.id = products_pdfs.product_id";
	$UsersResult=mysql_query($custQuery);
	$customerData=array();
	if(mysql_num_rows($UsersResult)>0)
	{
		
	

		$row_index=0;
		while($custRow=mysql_fetch_array($UsersResult))
		{
            
			
			$customerData[$row_index]["Active Status"]=$custRow["active_status"];
			$customerData[$row_index]["Customer"]=$custRow["firstname"]." ".$custRow["lastname"];
			$customerData[$row_index]["balance"]=$custRow["balance"];
			$customerData[$row_index]["balance_total"]=$custRow["balance_total"];
			$customerData[$row_index]["company"]=$custRow["company"];
			$customerData[$row_index]["mr_ms"]=$custRow["mr_ms"];
			$customerData[$row_index]["firstname"]=$custRow["firstname"];
			$customerData[$row_index]["mi"]=$custRow["mi"];
			$customerData[$row_index]["lastname"]=$custRow["lastname"];
			$customerData[$row_index]["contact"]=$custRow["contact"];
			$customerData[$row_index]["phoneno"]=$custRow["phoneno"];
			$customerData[$row_index]["fax"]=$custRow["fax"];
			$customerData[$row_index]["alt_phone"]=$custRow["alt_phone"];
			$customerData[$row_index]["alt_contact"]=$custRow["alt_contact"];
			$customerData[$row_index]["firstname"]=$custRow["mail"];
			$customerData[$row_index]["firstname"]=$custRow["bill_to_1"];
			$customerData[$row_index]["firstname"]=$custRow["bill_to_2"];
			$customerData[$row_index]["firstname"]=$custRow["bill_to_3"];
			$customerData[$row_index]["firstname"]=$custRow["bill_to_4"];
			$customerData[$row_index]["firstname"]=$custRow["bill_to_5"];
			
			$customerData[$row_index]["firstname"]=$custRow["ship_to_1"];
			$customerData[$row_index]["firstname"]=$custRow["ship_to_2"];
			$customerData[$row_index]["firstname"]=$custRow["ship_to_3"];
			$customerData[$row_index]["firstname"]=$custRow["ship_to_4"];
			$customerData[$row_index]["firstname"]=$custRow["ship_to_5"];
			
			$customerData[$row_index]["firstname"]=$custRow["customer_type"];
			$customerData[$row_index]["firstname"]=$custRow["terms"];
			$customerData[$row_index]["firstname"]=$custRow["rep"];
			$customerData[$row_index]["firstname"]=$custRow["sales_tax_code"];
			$customerData[$row_index]["firstname"]=$custRow["tax_item"];
			
			$customerData[$row_index]["firstname"]=$custRow["resale_num"];
			$customerData[$row_index]["firstname"]=$custRow["account_no"];
			$customerData[$row_index]["firstname"]=$custRow["credit_limit"];
			$customerData[$row_index]["firstname"]=$custRow["job_status"];
			$customerData[$row_index]["firstname"]=$custRow["job_type"];
			
			$customerData[$row_index]["firstname"]=$custRow["job_description"];
			$customerData[$row_index]["firstname"]=$custRow["start_date"];
			$customerData[$row_index]["firstname"]=$custRow["project_end"];
			$customerData[$row_index]["firstname"]=$custRow["end_date"];
			$customerData[$row_index]["firstname"]=$custRow["note"];
			
			
			$row_index+=1;
			
			
	
		}
	}

	return $customerData; 
}