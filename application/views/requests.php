<div class="CBcontent">
    <center>
    <h1>Transfer Requests</h1>
    </center>
    <br>
    <div class="CBdata">
<center>
        <?php

		$table = '<table border="0" cellpadding="0" cellspacing="0" class="datatable">';
		 $table .= '<thead>';
		 $table .= '<tr>';
		 $table .= '<th>';
		 $table .= 'Member';
		 $table .= '</th>';
                 $table .= '<th>';
		 $table .= 'From';
		 $table .= '</th>';
                 $table .= '<th>';
		 $table .= 'To';
		 $table .= '</th>';
                 $table .= '<th>';
		 $table .= 'Action';
		 $table .= '</th>';
		 $table .= '</tr>';
		 $table .= '</thead>';
		 $table .= '<tbody>';

if(isset($results) and !empty($results)): foreach($records as $row):
			 $table .= "<tr class='field_value' id='delinfogo$row->transfer_id'>";
			 $table .= '<td>';
			 $table .= "<a href='$view_url/viewRequest/$row->member_code'>".$row->member_lname.", ".$row->member_fname." ".$row->member_mname."</a>";
			 $table .= '</td>';
                         $table .= '<td>';
                         $table .= $row->transfer_from;
			 $table .= '</td>';
                         $table .= '<td>';
                         $table .= $row->transfer_to;
			 $table .= '</td>';
			 $table .= '<td>';
			 $table .= '<span id="' . $row->transfer_id . '" class="delinfogo"><a href="'.base_url().'area_controller/deleteRequest/'.$row->member_code.'"><img style="cursor:pointer" src="'. base_url() .'css/delete.png" title="Remove" /></a></span></td>';
			 $table .= '</tr>';
		 endforeach;
		 
		else:	 
		 	$table .= '<tr align="center"><td colspan="2">No Record Found</td></tr>';
		endif;
					 
				$table .= '</tbody>';
				$table .= '</table>';
   				echo $table;

             
?>
             </center>
<?php 
echo '<br>';
echo $this->pagination->create_links(); ?>
<script type="text/javascript">
 $(".field_value:odd").css("background","#A4DAFF");
</script>
</div>
</div>