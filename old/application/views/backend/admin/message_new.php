<div class="mail-header" style="padding-bottom: 27px ;">
    <!-- title -->
    <h4 class="mail-title">
        <?php echo get_phrase('write_new_message'); ?>
    </h4>
</div>

<div class="mail-compose">

    <div class="form-group">
        <label for="subject"><?php echo get_phrase('quizes'); ?>:</label>
        <br><br>
        <select class="form-control" id="quiz_select" >
            <option value="0">Select a quiz</option>
                <?php
                foreach($sub_categories as $category):?>
                    <option value="<?php echo $category['id']; ?>">
                        - <?php echo $category['name']; ?></option>
                <?php endforeach; ?>
        </select>
    </div>

    <?php echo form_open(site_url('admin/message/send_new'), array(
            'class' => 'form-groups form-horizontal', 'enctype' => 'multipart/form-data')); ?>


    <div class="form-group">
        <label for="subject"><?php echo get_phrase('recipient'); ?>:</label>
        <br><br>
        <select class="form-control select2 js-example-basic-multiple" name="reciever[]" required multiple="multiple" id="e1">
                <?php
                foreach($student_list as $student):?>
                    <option value="<?php echo $student['id']; ?>">
                        - <?php echo $student['first_name'].' '.$student['last_name']; ?></option>
                <?php endforeach; ?>
        </select>
        <input type="checkbox" id="checkbox" >Select All
    </div>


    <div class="compose-message-editor">
        <textarea rows="5" class="form-control wysihtml5" data-stylesheet-url="<?php echo base_url('assets/backend/css/wysihtml5-color.css');?>"
            name="message" placeholder="<?php echo get_phrase('write_your_message'); ?>"
            id="sample_wysiwyg" required></textarea>
    </div>

    <hr>

    <button type="submit" class="btn btn-success pull-right">
        <i class="fa fa-share"></i> &nbsp;<?php echo get_phrase('send_message'); ?>
    </button>
</form>

</div>

<script type="text/javascript">
    $("#checkbox").click(function(){
        if($("#checkbox").is(':checked') ){
            $("#e1 > option").prop("selected","selected");
            $("#e1").trigger("change");
        }else{
            $("#e1 > option").removeAttr("selected");
            $("#e1").trigger("change");
        }
    });

    $("#quiz_select").change(function(){
        var quiz_id = $(this).val();
        console.log(quiz_id);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/message/quizStudents');?>",
            data: { quiz_id: quiz_id} ,
            success: function (r) {
                $("#e1 > option").removeAttr("selected");
                $("#e1").trigger("change");
                $('#e1').empty();
                var data = $.parseJSON(r); 
                $.each(data, function(key, value) {
                    $('#e1').append('<option value="'+ value.id +'">'+ value.first_name +' '+value.last_name+'</option>');
                    $("#e1 > option").prop("selected","selected");
                    $("#e1").trigger("change");
                    $("#checkbox").prop('checked', true);
                });
            }
        });
    });

</script>