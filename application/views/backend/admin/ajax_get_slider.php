<table class="table table-bordered datatable" id="table-1">
<thead>
    <tr>
    <th><?php echo get_phrase('slider_type'); ?></th>
    <th><?php echo get_phrase('image'); ?></th>
    <th><?php echo get_phrase('Heading'); ?></th>
    <th><?php echo get_phrase('Button Text'); ?></th>
    <th><?php echo get_phrase('position'); ?></th>
    <th><?php echo get_phrase('status'); ?></th>
    <th><?php echo get_phrase('actions'); ?></th>
    </tr>
</thead>
<tbody>
    <?php
        $counter = 0; 
        foreach ($galleries->result_array() as $gallery): 
            $counter++; 
            if($gallery['type']=='slider' || $gallery['type']=='slider1'){
                $image = base_url().'uploads/slider/'.$gallery['image_name'];
                $delete = 'admin/slider/delete/'.$gallery['id'];
                $status = 'admin/slider/changeStatus/'.$gallery['id'];
            }
    ?>
        <tr class="gradeU">
            <td><?php 
                if($gallery['type']=='slider'):
                    echo 'Slider Upper';
                else:
                    echo 'Slider Lower';
                endif;
             ?></td>
            <td>
            <img src="<?php echo $image; ?>" alt="" width= "400" height="250">
            </td>
             <td><?php echo $gallery['htext']; ?></td>
             <td><?php echo $gallery['ptext']; ?></td>
            <td><input type="text" name="position" value="<?php echo $gallery['position']; ?>" id="<?php echo 'position'.$gallery['id']; ?>" ><a href="javascript:void(0);" type="button" class="btn btn-info" onclick="changePosition(<?php echo $gallery['id']; ?>)">Save</a></td>
            <td><?php 
                    if($gallery['status']==1){
                        echo '<a href="'.site_url($status).'">Active</a>';
                    }else{
                        echo 'In Active';
                    }
                ?>
            </td>
            <td><a href="#" onclick="confirm_modal('<?php echo site_url($delete); ?>');"><?php echo get_phrase('delete');?></a></td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>