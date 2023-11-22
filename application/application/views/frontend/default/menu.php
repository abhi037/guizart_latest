<!-- <div class="main-nav-wrap">
    <div class="mobile-overlay"></div>

    <ul class="mobile-main-nav">
        <div class="mobile-menu-helper-top"></div>

        <li class="has-children">
            <a href="">
                <i class="fas fa-th d-inline" style="max-height: 10px;"></i>
                <span><?php echo get_phrase('categories'); ?></span>
                <span class="has-sub-category"><i class="fas fa-angle-right"></i></span>
            </a>

            <ul class="category corner-triangle top-left is-hidden">
                <li class="go-back"><a href=""><i class="fas fa-angle-left"></i>Menu</a></li>
                <?php
                    $categories = $this->crud_model->get_categories()->result_array();
                    foreach ($categories as $category):?>
                    <li class="has-children">
                        <a href="#">
                            <span class="icon"><i class="<?php echo $category['font_awesome_class']; ?>"></i></span>
                            <span><?php echo $category['name']; ?></span>
                            <span class="has-sub-category"><i class="fas fa-angle-right"></i></span>
                        </a>
                        <ul class="sub-category is-hidden">
                            <li class="go-back-menu"><a href=""><i class="fas fa-angle-left"></i>Menu</a></li>
                            <li class="go-back"><a href="">
                                <i class="fas fa-angle-left"></i>
                                <span class="icon"><i class="<?php echo $category['font_awesome_class']; ?>"></i></span>
                                <?php echo $category['name']; ?>
                            </a></li>
                            <?php
                             $sub_categories = $this->crud_model->get_sub_categories($category['id']);
                             foreach ($sub_categories as $sub_category): ?>
                                <li><a href="<?php echo site_url('home/category/'.slugify($sub_category['name']).'/'.$sub_category['id']); ?>"><?php echo $sub_category['name']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>

        <div class="mobile-menu-helper-bottom"></div>
    </ul>
</div> -->

<div class="collapse navbar-collapse" id="navbar-menu">
    
                    <ul class="nav navbar-nav navbar-left" data-in="fadeInDown" data-out="fadeOutUp">
                          <li class="dropdown">
                            
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" ><span class="icon"><i class="fa fa-university mr-2" aria-hidden="true"></i></i><span> <?php echo get_phrase('categories'); ?></a>
                            <ul class="dropdown-menu">
                                 <?php
                    $categories = $this->crud_model->get_categories()->result_array();
                    foreach ($categories as $category):?>
                                
                               
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" ><span class="icon"><i class="<?php echo $category['font_awesome_class']; ?> mr-2"></i></span> <?php echo $category['name']; ?></a>
                                    <ul class="dropdown-menu pre-scrollable">
                                        <?php
                             $sub_categories = $this->crud_model->get_sub_categories($category['id']);
                             foreach ($sub_categories as $sub_category): ?>
                                        <li><a href="<?php echo site_url('home/category/'.slugify($sub_category['name']).'/'.$sub_category['id']); ?>"><?php echo $sub_category['name']; ?></a></li>
                                                <?php endforeach; ?>
                                    </ul>
                                </li>
                           
                                 <?php endforeach; ?>
                            </ul>
                              
                        </li>

                      
                       
                      
                      <!-- <li class="dropdown">

                           
                              <?php
                        if(isset($hightligt_quiz[0])) {  ?>
                         
                        
                          
                                  
                                  

                     
    		
    	
    		
    		  
    		  	<?php if($hightligt_quiz[0]->price=='0' || $hightligt_quiz[0]->price=='0.00') { ?>
    		  		<a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo site_url('home/highlightquiz/' . (isset($hightligt_quiz[0]->id) ? md5($hightligt_quiz[0]->id) : "")); ?>"><span class="icon">    <i class="fa fa-bullhorn  mr-2" aria-hidden="true"></i>  </span> <?php echo isset($hightligt_quiz[0]->title) ? $hightligt_quiz[0]->title : '' ?> Enroll Now..!!</a>
  		  		<?php } else {?>
  		  			<a class="dropdown-toggle" data-toggle="dropdown"  data-target="#EnrollUpModel" href="#"><span class="icon">    <i class="fa fa-bullhorn  mr-2" aria-hidden="true"></i>  </span>  Enroll Now..!!</a>
  		  		<?php } ?> 
    		 
    	
  
	
	

                               
                               
                           
                            
	<?php } ?>
                           
                        </li> -->
                   <!--   <li class="dropdown"> 
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" >Teachers</a>
                            <ul class="dropdown-menu">
                                <li><a href="advisors.html">Teachers One</a></li>
                                <li><a href="advisors-2.html">Teachers Two</a></li>
                                <li><a href="advisor-single.html">Teacher Single</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" >Blog</a>
                            <ul class="dropdown-menu">
                                <li><a href="blog-standard.html">Blog Standard</a></li>
                                <li><a href="blog-with-sidebar.html">Blog With Sidebar</a></li>
                                <li><a href="blog-2-colum.html">Blog Grid Two Colum</a></li>
                                <li><a href="blog-3-colum.html">Blog Grid Three Colum</a></li>
                                <li><a href="blog-single.html">Blog Single</a></li>
                                <li><a href="blog-single-with-sidebar.html">Blog Single With Sidebar</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="contact.html">Contact</a>
                        </li> -->
                    </ul>

                </div><!-- /.navbar-collapse -->
