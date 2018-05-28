<?php
	
	namespace App\Controller\Provider;
	
	use App\Controller\AppController;
	use DOMPDF;
	//include this line for data base connection
	use Cake\Datasource\ConnectionManager;
	 
	class PrismsImportsController extends AppController {
	  
	  public function add() {
				$conn = ConnectionManager::get('default'); //initialize this default connection manager
				if (isset($_POST['submit'])) { 
					$table_name = "prisms_imports";
					 $t              = time(); 
					 $uploadFilePath = WWW_ROOT . DS . 'import_data_csv/prisms/' . $t . basename($_FILES['import_file']['name']);
					 move_uploaded_file($_FILES['import_file']['tmp_name'], $uploadFilePath);//upload the csv file into our location
					 $handle = fopen($uploadFilePath, "r");
					 $getCSV = fgetcsv($handle, 0, ",");
					 $toGetTablesList = "show tables like '".$table_name."'";
					 $toGetTablesList = $conn->execute($toGetTablesList);
					 $results = $toGetTablesList->fetch();
					 //Whether table is created or not , if table is not created then its creates the table dynamically with first row of csv
					 if($results[0] !== $table_name) {
							 $query = 'create table  '.$table_name.' (id int UNSIGNED AUTO_INCREMENT PRIMARY KEY, ';
							 for($i=0;$i<count($getCSV);$i++) {
								if($i !== count($getCSV)-1) {
									$query = $query.str_replace(' ', '_', str_replace('/','_', $getCSV[$i])).' text ,'; 
								}else {
									$query = $query.str_replace(' ','_', str_replace('/','_', $getCSV[$i])).' text )';
								} 
							 } 
							$query = str_replace("_(OSHC)"," ", $query);
							$query = str_replace("__","_", $query);
							$stmt = $conn->execute($query); 
					 }
					 
					 //Turncate the already existed data
					 if(isset($_POST['truncate'])) {
						 $conn->execute("truncate table ".$table_name); 
					 }
					 
					 //To get the columns name from table in database
					$toGetFieldsData = "SELECT COLUMNS.COLUMN_NAME FROM information_schema.COLUMNS COLUMNS WHERE (COLUMNS.TABLE_NAME = '".$table_name."')  AND (COLUMNS.TABLE_SCHEMA = 'applyonce')";
					  $result = $conn->execute($toGetFieldsData);
					  $r = $result->fetchAll(); 
					  $fields;
					  for($i=1;$i<count($r);$i++) {
						 foreach($r[$i] as $k => $v) {
							$fields[] = $v;
						 }
					  }  
					$this->dataCSV = $getCSV;
					$this->loadModel('PrismsImports');
					//To insert the data into table from uploaded fiel
					while(($getCSV = fgetcsv($handle, 0, ",")) !== false) {
								$columns = implode(",",array_values($fields));
								$values  = implode('","',array_values($getCSV)); 
								
								$query = 'insert into '.$table_name.'  ('.$columns.') values ("'.trim($values).'")';//insert Query in Mysql
								$result = $conn->execute($query); //execute the Query
					} 
					$this->Flash->success(__('Imported Successfully.'));			 
			}
		}
		  
	}	