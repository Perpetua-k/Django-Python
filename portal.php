
<style>
	header.masthead{
		background-image: url('<?php echo validate_image($_settings->info('cover')) ?>') !important;
	}
	header.masthead .container{
		background:#0000006b;
	}
	/*image slider starts here*/
    .slider{
        width: 800px;
        height: 500px;
        border-radius: 10px;
        overflow: hidden;
        justify-content: space-around;
        margin: 0 10px;
        position: relative;
        align-items: center;
        justify-items: center;
    }

    .slides{
        width: 500%;
        height: 500px;
        display: flex;
    }

    .slides input{
        display: none;
    }

    .slide{
        width: 20%;
        transition: 2s;
        text-align: center;
        align-items: center;
    }
       .slide h2{
        color: #fff;
        font-size: 20px;
        letter-spacing: 3px;
        padding: 0 20px;
        margin-bottom: 5px;
        margin-right: 5px;
    }
        
        .slide img{
            width: 650px;
            height: 420px;
            border-radius: .5em;
            align-items: center;
            justify-content: center;
            text-shadow: 0 0 50px;
        }
		/*css for manual slide navigation*/

		.navigation-manual{
        position: absolute;
        width: 800px;
        margin-top: -40px;
        display: flex;
        justify-content: center;
    }

    .manual-btn{
        border: 2px solid #40D3DC;
        padding: 5px;
        border-radius: 10px;
        cursor: pointer;
        transition: 1s;
    }

    .manual-btn::not(:last-child){
        margin-right: 40px;
    }

    .manual-btn:hover{
        background: #40D3DC;
    }

    #radio1:checked~ .first{
        margin-left: 0;
    }
    #radio2:checked~ .first{
        margin-left: -20%;
    }
    #radio3:checked~ .first{
        margin-left: -40%;
    }
    #radio4:checked~ .first{
        margin-left: -60%;
    }

    /*css for automatic navigaton*/
    
    
</style>
<!-- Masthead-->
<header class="masthead">
	<div class="container">
		<div class="masthead-subheading">Welcome To Kosen Tours</div>
		<div class="masthead-heading text-uppercase">The World is a book and Those who do not travel read only a page...</div>
		<a class="btn btn-primary btn-xl text-uppercase" href="#home">View Tours</a>
	</div>
	<!--image slider starts-->
	<div class="slider">
                <div class="slides">
                    <!--radio button starts-->
                    <input type="radio" name="radio-btn" id="radio1">
                    <input type="radio" name="radio-btn" id="radio2">
                    <input type="radio" name="radio-btn" id="radio3">
                    <input type="radio" name="radio-btn" id="radio4">
                    <!--radio button end-->

                    <!--slide images start-->
                    
                    <div class="slide first">
                    <h2>Balloon Safaris</h2>
                        <p> From ballooning discover the experience that will stir your soul...Stuuning views...something you can't get from a jeep</p><br>
                        <img src="uploads/Balloon.jpg" alt="">
                    </div>

                    <div class="slide">
                    <h2>Great Migration</h2>
                        <p> A journey for the emotion...for many... a dream of a lifetime by creating memories. It definitely has to be on everyone's Bucket List!</p><br>
                        <img src="uploads/Mara migration.jpg" alt="">
                    </div>

                    <div class="slide">
                    <h2>Game Drives</h2>
                        <p> Every dawn is a different adventure, a serene silence travelling in the wild...essentials Africa</p><br>
                        <img src="uploads/drives.jpg" alt="">
                    </div>
                    <div class="slide">
                    <h2>Maasai Culture</h2>
                        <p> Get to experience the Maasai Culture... A lifetime experience that will leave you breathless!</p><br>
                        <img src="uploads/Maasai Culture.jpg" alt="">
                    </div>
                </div>
                <!--slide images end-->
                <!--automatic navigation starts-->
                <div class="navigation-auto">
                    <div class="auto-btn1"></div>
                    <div class="auto-btn2"></div>
                    <div class="auto-btn3"></div>
                    <div class="auto-btn4"></div>
                </div>
                 <!--automatic navigation ends-->
				 </div>
            <!--manual navigation starts--> 
            <div class="navigation-manual">
                <label for="radio1" class="manual-btn"></label>
                <label for="radio2" class="manual-btn"></label>
                <label for="radio3" class="manual-btn"></label>
                <label for="radio4" class="manual-btn"></label>
            </div>
            <!--manual navigation ends-->  
        <!--image slider ends-->
	</div>
	<script type="text/javascript">
            var counter =1;
            setInterval(function(){
                document.getElementById('radio' + counter). checked = true;
                counter ++;
                if(counter > 4){
                    counter = 1;
                } 
            },5000);
            
        </script>

</header>
<!-- Services-->
<section class="page-section bg-dark" id="home">
	<div class="container">
		<h2 class="text-center">Tour Packages</h2>
	<div class="d-flex w-100 justify-content-center">
		<hr class="border-warning" style="border:3px solid" width="15%">
	</div>
	<div class="row">
		<?php
		$packages = $conn->query("SELECT * FROM `packages` order by rand() limit 3");
			while($row = $packages->fetch_assoc() ):
				$cover='';
				if(is_dir(base_app.'uploads/package_'.$row['id'])){
					$img = scandir(base_app.'uploads/package_'.$row['id']);
					$k = array_search('.',$img);
					if($k !== false)
						unset($img[$k]);
					$k = array_search('..',$img);
					if($k !== false)
						unset($img[$k]);
					$cover = isset($img[2]) ? 'uploads/package_'.$row['id'].'/'.$img[2] : "";
				}
				$row['description'] = strip_tags(stripslashes(html_entity_decode($row['description'])));

				$review = $conn->query("SELECT * FROM `rate_review` where package_id='{$row['id']}'");
				$review_count =$review->num_rows;
				$rate = 0;
				while($r= $review->fetch_assoc()){
					$rate += $r['rate'];
				}
				if($rate > 0 && $review_count > 0)
				$rate = number_format($rate/$review_count,0,"");
		?>
			<div class="col-md-4 p-4 ">
				<div class="card w-100 rounded-0">
					<img class="card-img-top" src="<?php echo validate_image($cover) ?>" alt="<?php echo $row['title'] ?>" height="200rem" style="object-fit:cover">
					<div class="card-body">
					<h5 class="card-title truncate-1 w-100"><?php echo $row['title'] ?></h5><br>
					<div class=" w-100 d-flex justify-content-start">
						<div class="stars stars-small">
								<input disabled class="star star-5" id="star-5" type="radio" name="star" <?php echo $rate == 5 ? "checked" : '' ?>/> <label class="star star-5" for="star-5"></label> 
								<input disabled class="star star-4" id="star-4" type="radio" name="star" <?php echo $rate == 4 ? "checked" : '' ?>/> <label class="star star-4" for="star-4"></label> 
								<input disabled class="star star-3" id="star-3" type="radio" name="star" <?php echo $rate == 3 ? "checked" : '' ?>/> <label class="star star-3" for="star-3"></label> 
								<input disabled class="star star-2" id="star-2" type="radio" name="star" <?php echo $rate == 2 ? "checked" : '' ?>/> <label class="star star-2" for="star-2"></label> 
								<input disabled class="star star-1" id="star-1" type="radio" name="star" <?php echo $rate == 1 ? "checked" : '' ?>/> <label class="star star-1" for="star-1"></label> 
						</div>
                    </div>
    				<p class="card-text truncate"><?php echo $row['description'] ?></p>
					<div class="w-100 d-flex justify-content-end">
						<a href="./?page=view_package&id=<?php echo md5($row['id']) ?>" class="btn btn-sm btn-flat btn-warning">View Package <i class="fa fa-arrow-right"></i></a>
					</div>
					</div>
				</div>
			</div>
		<?php endwhile; ?>
	</div>
	<div class="d-flex w-100 justify-content-end">
		<a href="./?page=packages" class="btn btn-flat btn-warning mr-4">Explore Package <i class="fa fa-arrow-right"></i></a>
	</div>
	</div>
</section>
<!-- Itinerary-->
<section class="page-section" id="itinerary">
	<div class="container">
		<div class="text-center">
			<h2 class="section-heading text-uppercase">Itinerary</h2>
		</div>
		<div>
			<div class="card w-100">
				<div class="card-body">
					<?php echo file_get_contents(base_app.'about.html') ?>
					<div class = "book-button">
                    
                            <a href="/project/js.pdf/pdf" target="_blank" class = "btn btn-pdf" style="width:100%"><i class="fa fa-file-pdf-o"></i> View Itinerary in PDF</a>
                        
                    </div>
					.view
                    <div class = "book-button" style="margin-top: 10px;">
                    
                        <a href="/static/documents/Flight Package.pdf" download class = "btn btn-pdf" style="width:100%"><i class="fa fa-file-pdf-o"></i> Download Reservation Form</a>
                        
                    
                    </div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Contact-->
<section class="page-section" id="contact">
	<div class="container">
		<div class="text-center">
			<h2 class="section-heading text-uppercase">Contact Us</h2>
			<h3 class="section-subheading text-muted">Send us a message for inquiries.</h3>
		</div>
		<!-- * * * * * * * * * * * * * * *-->
		<!-- * * SB Forms Contact Form * *-->
		<!-- * * * * * * * * * * * * * * *-->
		<!-- This form is pre-integrated with SB Forms.-->
		<!-- To make this form functional, sign up at-->
		<!-- https://startbootstrap.com/solution/contact-forms-->
		<!-- to get an API token!-->
		<form id="contactForm" >
			<div class="row align-items-stretch mb-5">
				<div class="col-md-6">
					<div class="form-group">
						<!-- Name input-->
						<input class="form-control" id="name" name="name" type="text" placeholder="Your Name *" required />
					</div>
					<div class="form-group">
						<!-- Email address input-->
						<input class="form-control" id="email" name="email" type="email" placeholder="Your Email *" data-sb-validations="required,email" />
					</div>
					<div class="form-group mb-md-0">
						<input class="form-control" id="subject" name="subject" type="subject" placeholder="Subject *" required />
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group form-group-textarea mb-md-0">
						<!-- Message input-->
						<textarea class="form-control" id="message" name="message" placeholder="Your Message *" required></textarea>
					</div>
				</div>
			</div>
			<div class="text-center"><button class="btn btn-primary btn-xl text-uppercase" id="submitButton" type="submit">Send Message</button></div>
		</form>
	</div>
</section>
<script>
$(function(){
	$('#contactForm').submit(function(e){
		e.preventDefault()
		$.ajax({
			url:_base_url_+"classes/Master.php?f=save_inquiry",
			method:"POST",
			data:$(this).serialize(),
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("an error occured",'error')
				end_loader()
			},
			success:function(resp){
				if(typeof resp == 'object' && resp.status == 'success'){
					alert_toast("Inquiry sent",'success')
					$('#contactForm').get(0).reset()
				}else{
					console.log(resp)
					alert_toast("an error occured",'error')
					end_loader()
				}
			}
		})
	})
})
</script>