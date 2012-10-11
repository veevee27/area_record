<div class="CBcontent">
    <?php
        foreach($results as $row)
        {
            echo '<strong>Date: '.$row->meeting_date.'</strong><br><br>';
            echo '<strong>Agenda: </strong>'.$row->meeting_agenda;
        }
    ?>
    <br>
    <a href="<?php echo base_url();?>area_controller/meetings" class="CBButton">Back to Meeting Lists</a>
</div>
