<?php foreach($galleries->result_array() as $gallery): ?>
        <div class="col-lg-3 col-md-4 col-6">
            <a href="#" class="d-block mb-4 h-100">
                <img class="img-fluid img-thumbnail" src="<?php echo base_url().'uploads/gallery/'.$gallery['image_name']; ?>" alt="">
            </a>
        </div>
<?php endforeach; ?>
<input type="hidden" id="start" value="<?php echo $start; ?>">