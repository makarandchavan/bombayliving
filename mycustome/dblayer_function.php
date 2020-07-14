<?php
function value_valid_check($type,$value)
 {
    $is_valid=true;
    switch($type)
    {
        case 'alpha_num':
         if(preg_match('/^[A-Za-z0-9_ ]+$/',$value)==false)
         {
            $is_valid=false;
         }

        break;
        case 'empty':
         if($value=="")
         {
            $is_valid=false;
         }
        break;
        case 'select':
         if($value=="0")
         {
           
            $is_valid=false;
         }
        break;
        case 'date':
         if(preg_match('/([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})/',$value)==false)
         {
            $is_valid=false;
         }
        break;
        case 'email':
        
        if(preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/',$value)==false)
         {
            $is_valid=false;
         }
        break;
        
    }
    return $is_valid;
 }
 

 
 
 function  vailidation_check(&$data_array)
 {
    foreach($data_array as $index => $data_infoArray )
    {
         if(value_valid_check($data_infoArray["type"],$data_infoArray["value"])==false)
         {
         //  echo '<br> value '.$data_infoArray["value"];
          // echo '<br> type '.$data_infoArray["type"];
        
            $data_array[$index]["error_msg"]=$data_infoArray["error_msg"];
            $data_array[$index]["status"]=0;      
         }
        
    }
    
 }

	function is_already_entry($table_name="",$field_array=array())
	{
		$already_flag=false;
		$query="select count(*)as row_count from ".$table_name."
                   where ";
		foreach($field_array as $field_name => $field_value)
		{
			$query.=" `$field_name` = '".$field_value."' and";
		}
		$query=trim($query,"and");
		//   name like '".$title."' and description like '".$desc."' and filename like '".$file_name."'";
	
	
		$qrun=mysql_query($query);
		$row=@mysql_fetch_array($qrun);
	
		if($row["row_count"]>0)
		{
			$already_flag=true;
		}
		return $already_flag;
	
	}
  	function  insert_record($table_name="",$field_array=array())
	{
		  $is_insert=false;
				$query="insert into  ".$table_name." ";
				$query.="(";
				foreach($field_array as $field_name => $value)
				{
					$query.="`$field_name`,";
				}
				$query=trim($query,",");
			
				$query.=") values (";
			
				foreach($field_array as $field_name => $value)
				{
				  $query.=":".$field_name.",";
				}
				$query=trim($query,",");
				 
			
				$query.=")";
                
                $fieldValueArray=array();
                foreach($field_array as $field_name => $value)
                {
                    $fieldValueArray[':'.$field_name]=$value;
                }
			
			//echo "<br>".$query;
          //  exit();
					if(db_query($query,$fieldValueArray))
                    {
                       $is_insert=true; 
                    }	
		     	return $is_insert;
		}
	
		function update_record($table_name="",$field_array=array(),$conditionArray="")
		{
			 try
			 {
			    $is_update=false;  
			     
			    $valueFieldArray=array(); 
			    $query="update  $table_name set ";
		
				foreach($field_array as $field_name => $value)
				{
				  $query.="`$field_name`=:$field_name,";
                  $valueFieldArray[":".$field_name]=$value;
		        }
		        $query=trim($query,",");
		       if(count($conditionArray)>0)
		       {
		          $c_index=1;
		          foreach($conditionArray as $con_index => $conVal)
                  {
		            $query.=" ".$con_index.":cond".$c_index;
                     $valueFieldArray[":cond".$c_index]=$conVal;
                    $c_index+=1;
                  }
				}
              
				if(db_query($query,$valueFieldArray))
                $is_update=true;
          
                
                return $is_update;
        
			 }
			 catch(Exception $error_ob)
			 {
			 	 echo "<br/>Exceptin Error ".mysql_error();
			 }
		 }
	
			function delete_table_entry($table_name="",$field_array=array())
			{
				$index_name=$field_array["index_name"];
				$index_value=$field_array["index_value"];
				$query="delete from $table_name where $index_name='".$index_value."'";
				$qrun=mysql_query($query);	
				return $qrun; 
			}
          