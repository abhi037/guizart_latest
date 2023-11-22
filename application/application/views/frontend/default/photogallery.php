<section class="page-header-area">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="page-title"><?php echo $page_title; ?></h1>
            </div>
        </div>
    </div>
</section>

<section class="my-courses-area">
    <!-- Page Content -->
<div class="container">

  <h1 class="font-weight-light text-center text-lg-left mt-4 mb-0">Thumbnail Gallery</h1>

  <hr class="mt-2 mb-5">

  <div class="row text-center text-lg-left" id="gallery">
    <?php foreach($galleries->result_array() as $gallery): ?>
        <div class="col-lg-3 col-md-4 col-6">
            <a href="<?php echo base_url().'uploads/gallery/'.$gallery['image_name']; ?>" data-lightbox="image" class="d-block mb-4 h-100"> <img class="img-fluid img-thumbnail" src="<?php echo base_url().'uploads/gallery/'.$gallery['image_name']; ?>" alt="">
            </a>
        </div>
    <?php endforeach; ?>
  </div>
  <div class="row" id="load-more">
    <div class="col text-center">
      <button class="btn btn-primary" onclick="ajax_get_gallery()">Load More</button>
      <input type="hidden" id="start" value="8">
    </div>
  </div>

  <div class="row" id="no-more" style="display:none;">
    <div class="col text-center">
      <button class="btn btn-primary">No More Data</button>
    </div>
  </div>

</div>
<!-- /.container -->

</section>


<script type="text/javascript">
    function ajax_get_gallery(){
        var start = $('#start').val();
        $.ajax({
            url: '<?php echo site_url('home/ajax_get_gallery/');?>'+start,
            success: function(response)
            {
                if(response != 0){
                    $('#start').remove();
                    jQuery('#gallery').append(response);
                }else{
                    $('#load-more').css('display', 'none');
                    $('#no-more').css('display', 'block');
                }
            }
        });
    }
</script>