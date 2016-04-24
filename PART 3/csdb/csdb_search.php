<?php  


function csdb_serach_result_function (){
	global $wpdb;

$table_name = $wpdb->prefix.'csdb';
	$search_form = '<form action="" method="post" class="csdb_search">
		<input type="text" name="search" placeholder="ENTER ROLL OR NAME" />
		<input type="submit" name="search_submit" />
	
	</form>';
	
	if(isset($_POST['search_submit'])){
		$serach_query = esc_sql($_POST['search']);
		if(empty($serach_query)){
			return $serach_query.'<br /> <p> write rool number or name to get result </p>';
		}else{
			
			$sql = $wpdb->get_results( "SELECT * FROM ".$table_name." WHERE name like '%".$serach_query."%' OR roll like '%".$serach_query."%' ", ARRAY_A );
			if(!empty($sql)){
				$table ='<table class="serach_table" >
						<tr class="seacr_tr" >
							<th>NAME</th>
							<th>ROLL</th>
							<th>TOTAL</th>
							<th>STATUS</th>
						</tr>';
				foreach($sql as $single_result ){
					
						$table .='<tr>';
							$table .='<td>'.$single_result['name'].'</td>';
							$table .='<td>'.$single_result['roll'].'</td>';
							$table .='<td>'.$single_result['total_num'].'</td>';
							$table .='<td>'.$single_result['status'].'</td>';
						$table .= '<tr>';
					
					
					
				}
				$table .='</table>';
				return $search_form.'<br><p>SEARCH RESULT OF '.$serach_query.'</p><br>'.$table;
				
			}else{
				return $serach_query.'<br /> <p> NO RESULT FOUND OF YOUR SEARCH QUERY <span>"'.$serach_query.'"</span> </p>';
				
			}
			
			
			
			
			
		}
		
		
		
		
		
	}else{
		 return $search_form;
		
	}
	
	
	
	
	
	
	
}