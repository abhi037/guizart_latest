<table class="table table-bordered datatable" id="table-1">
<thead>
    <tr>
    <th><?php echo get_phrase('s. no.'); ?></th>
    <th><?php echo get_phrase('image'); ?></th>
    <th><?php echo get_phrase('actions'); ?></th>
    </tr>
</thead>
<tbody>
    <?php
        $counter = 0; 
        foreach ($galleries->result_array() as $gallery): 
            $counter++; 
            if($gallery['type']=='slider'){
                $image = base_url().'uploads/slider/'.$gallery['image_name'];
                $delete = 'admin/slider/delete/'.$gallery['id'];
            }else{
                $image = base_url().'uploads/gallery/'.$gallery['image_name'];
                $delete = 'admin/photogallery/delete/'.$gallery['id'];
            }
    ?>
        <tr class="gradeU">
            <td><?php echo $counter; ?></td>
            <td>
            <img src="<?php echo $image; ?>" alt="" width= "400" height="250">
            </td>
            <td><a href="#" onclick="confirm_modal('<?php echo site_url($delete); ?>');"><?php echo get_phrase('delete');?></a></td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>