
    <section class=innerpage_all_wrap>
        <div class=container>
            <div class=row><h2 class=heading>get in <span>touch</span></h2>

                <p class=headParagraph>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat quisquam
                    reprehenderit, blanditiis nam debitis libero facilis illum repudiandae eveniet voluptatibus
                    quibusdam illo ea nisi ipsa accusantium nobis animi asperiores quaerat ,Lorem ipsum dolor sit amet,
                    consectetur adipisicing elit. Fugiat quisquam reprehenderit, blanditiis nam debitis libero facilis
                    illum repudiandae eveniet voluptatibus quibusdam illo ea nisi ipsa accusantium nobis animi
                    asperiores quaerat .</p>

                <div class=innerWrapper>
                    <ul class="contact_icon clearfix">
                        <li><a href=tel:80052608885263><i class="fa fa-phone"></i> <span>+1 800-256-9876</span></a></li>
                        <li><a href=mailto:mail@yoursite.com><i class="fa fa-envelope-o"></i>
                            <span>info@soccerclub.com</span></a></li>
                        <li><a href=#><i class="fa fa-map-marker"></i> <span>321/1 bakersssstreet,Newwork</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div class=container>
        <div class=row>
    		<h2 style="color:green">
    	        <?php
    	            if(isset($_SESSION['msg'])){
                        if($_SESSION['msg']){
                            echo "mail sent";
                            unset($_SESSION['msg']);
                        }else{
                            echo "mail problem";
                            unset($_SESSION['msg']);
                        }
                        
                    }
    	        ?>
    	    </h2>
            <div class=contact_form>
                <h2 class=heading>contact us <span>by form</span></h2>
                <p class=headParagraph>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat quisquam
                        reprehenderit, blanditiis nam debitis libero facilis illum repudiandae eveniet voluptatibus
                        quibusdam illo ea nisi ipsa accusantium nobis animi asperiores quaerat ,Lorem ipsum dolor sit
                        amet .</p>
    			<form data-parsley-validate="" name=contact class="formcontact clearfix" method="POST" action="mail.php">
                
                    <div class=form-group>
                        <input type=text class=form-control
                            name=name placeholder=Name required=""
                            data-parsley-required-message="please insert Name" />
                    </div>
                    <div class=form-group>
                        <input type=text class=form-control
                            name=phone placeholder=Phone
                            required="" data-parsley-required-message="please insert Phone No" />
                    </div>
                    <div class=form-group>
                        <input type=text class=form-control
                            name=subject placeholder=subject
                            required="" data-parsley-required-message="please insert subject" />
                    </div>
                    <div class=form-group>
                        <input type=email class=form-control
                        name=email placeholder=Email
                        required="" data-parsley-required-message="please insert Email" />
                    </div>
                    <div class=form-group1>
                        <textarea class="form-control textas"
                            name=comment placeholder=Message
                            required="" data-parsley-minlength=20
                            data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.."
                            data-parsley-validation-threshold=10
                            data-parsley-maxlength=100></textarea>
                    </div>
    				<button type="submit" name="sub" class="btn btn-red" id=send>send Us</button>

                    <div class=form-message></div>
                </form>
            </div>
        </div>
    </div>
        
    <!-- Footer -->
    <footer class=footer-type01>