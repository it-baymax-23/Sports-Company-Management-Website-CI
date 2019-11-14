    <?php if (count($sliders)) { ?>
    <section id="tiny" class="tinyslide">
      <aside class="slides">
        <?php foreach($sliders as $slider) { ?>
        <figure>
          <img src="<?php echo base_url() . $slider['slider_url']; ?>" width="100%" height="100%" alt="" />
          <figcaption>
            <?php echo $slider['slider_title']?>
          </figcaption>
        </figure>
        <?php } ?>
      </aside>
    </section>
    <?php } else { ?>
    <div class=banner id=layerSlider style="width: 100%;">
        <div class=ls-slide data-ls="transition3d: 33,15; slidedelay: 8000 ; durationin:0;">
            <img src=<?php echo base_url();?>assets/front/images/banner/background01.jpg class=ls-bg alt="Slide background">

            <div class="ls-l layercontent01" style="top: 50%; left: 50%; z-index:4;" data-ls="offsetxin:left; offsetxout:right; durationin: 4000; parallaxlevel: 8;">
                 <img src=<?php echo base_url();?>assets/front/images/banner/player.png alt=innerimage class=img-responsive style="max-width: 100% !important ;">
             </div>
            <img src=<?php echo base_url();?>assets/front/images/banner/ball.png alt=innerimage class="ls-l layercontent02" style=z-index:5; data-ls="offsetxin: right; offsetxout:left; rotatein:-360; easingin: easeoutquart; durationin: 4000; delayin: 250; parallaxlevel: -5;">
            <img src=<?php echo base_url();?>assets/front/images/banner/front_particles.png alt=particles class=ls-l style="z-index:3; left:0;" data-ls="offsetxin: left; offsetxout:left; scalexin:50; easingin: easeoutquart; durationin: 3000; delayin: 250;">
            <img src=<?php echo base_url();?>assets/front/images/banner/back_particles.png alt=particles class=ls-l style="z-index:3; left:50%;" data-ls="offsetxin: left; offsetxout:left; scalein:90; easingin: easeoutquart; durationin: 3000; delayin: 250;">

            <h2 class="ls-l bannertext layercontent03" data-ls="offsetxin:left; rotatexin:90 ; durationin: 3500;"> Ready </h2>

            <h2 class="ls-l bannertext01 italic01 layercontent04" data-ls="offsetxin:left; scalexin:9; durationin: 4000;">to </h2>
            <h4 class="ls-l bannertext02 layercontent05" data-ls="offsetxin:left; rotatexin:90 ; durationin: 4500;"> Join? </h4>

            <h2 class="ls-l bannertext01 layercontent06" style="left: 87%; top:760px;" data-ls="offsetxin:left; flipxin:90 ; durationin: 5000;"><sup>LA Aztecs</sup></h2>
            <h6 class="ls-l bannertext03 layercontent07" data-ls="offsetxin:left; flipxin:90 ; durationin: 6000;"> September, 2019 </h6>
        </div>
    </div>
    <?php } ?>

    <div class=banner-text>
        <div class=container>
            <div class=row>Are you Ready?<sup></sup> September , 2019.</div>
        </div>
    </div>

    <section class="booking bg-smallwhite">
        <div class=container>
            <div class=booking-fig><h2>Los Angeles Aztecs </h2></div>
            <div class=booking-content><a href=<?php echo base_url();?>academy class="btn btn-red">Join the Academy</a></div>
        </div>
    </section>

    <section class=about>
        <div class=container>
            <div class=row>

                <div class=about-wrap>
                    <div class=nav-header id=aboutTab>
                        <ul class="nav nav-tabs clearfix" role=tablist>
                            <li class=active><a href=#matches aria-controls=matches role=tab data-toggle=tab>Schedule</a></li>
                            <li><a href=#static aria-controls=static role=tab data-toggle=tab>Tournaments</a>
                            </li>
                            <li><a href=#traning aria-controls=traning role=tab data-toggle=tab>Training</a></li>
                        </ul>
                    </div>
                    <div class="tab-content nav-content">
                        <div role=tabpanel class="tab-pane active fade in" id=matches>
                            <div class="card mb-3">
                              <div class="card-header bg-info text-center text-white">
                                <h3>Schedule</h3></div>
                              <div class="card-body">
                                <ul class="list-group text-center">
                                  <?php foreach ($schedules as $schedule) { ?>
                                    <li class="list-group-item text-center">VS <?php
                                      foreach ($teams as $team) { 
                                        if ($schedule['team_id'] == $team['id']) { 
                                          echo $team['team_name']; }} ?> Team <?php $date = date_create($schedule['match_time']); echo date_format($date, 'D\. M jS\. Y g:ia');?><br/> Location <?php echo $schedule['match_location']; ?> </li>
                                  <?php } ?>
                                </ul>
                              </div>
                            </div>
                        </div>

                        <div role=tabpanel class="tab-pane fade" id=static>
                            <div class="card mb-3">
                              <div class="card-header bg-info text-center text-white">
                                <h3>Tournament</h3>
                              </div>
                              <div class="card-body">
                                <ul class="list-group text-center">
                                  <?php foreach ($tournaments as $tournament) { ?>
                                    <li class="list-group-item text-center"> 
                                    <?php echo $tournament['tournament_name']?>. Starts <?php $date = date_create($tournament['start_datetime']); echo date_format($date, 'D\. M jS\. Y g:ia');?>. Location: <?php echo $tournament['tournament_location']?>.
                                    </li>
                                  <?php } ?>
                                </ul>
                              </div>
                            </div>
                        </div>

                        <div role=tabpanel class="tab-pane fade" id=traning>
                            <div class="card mb-3">
                              <div class="card-header bg-info text-center text-white">
                                <h3>Training</h3>
                              </div>
                              <div class="card-body">
                                <ul class="list-group text-center">
                                  <?php foreach ($trainings as $training) { ?>
                                    <li class="list-group-item text-center"> 
                                    <?php echo $training['training_name']?>. Starts <?php $date = date_create($training['start_datetime']); echo date_format($date, 'D\. M jS\. Y g:ia');?>. Duration: <?php echo $training['training_duration']?>. Location: <?php echo $training['training_location']?>.
                                    </li>
                                  <?php } ?>
                                </ul>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if (!($latest_result)) { ?>
    <section class=latestResult>
        <div class=container>
            <div class=row><h2 class=heading>latest <span>result</span></h2>

                <div class=latestResult-wrap><h4>Friendly Match</h4>

                    <p>Sponsored by Nifty Services</p></div>
                <div class="result clearfix">
                    <div class=result-details>
                        <div class=content><h4>LA Aztecs</h4>

                            <p>Win</p>

                            <p>Ethan Diaz (27)</p>
                            <p>Ethan Diaz (45)</p>
                            <p>Panda (77)</p>
                        </div>
                           
                        <div class=figure>
                            <div class=team-logo>
                                <div style="background-image: url(<?php echo base_url();?>assets/front/images/team-logo/logo01.png)" class=teamLogoImg></div>
                            </div>
                        </div>
                    </div>
                    <div class=result-count>
                        <div class=count-number><span class=lose-team>3</span> <span>-</span> <span
                                class=win-team>1</span></div>
                        <div class=dateTime>
                            <div class=dateTime-container><span class=date>May 17,2019</span> <span
                                    class=time>1:30pm</span></div>
                            <div class=country-wrap><span class=field>Salesian stadium</span> 
                            </br><span class=country>(Los Angeles)</span>
                            </div>
                        </div>
                    </div>
                    <div class=result-details>
                        <div class="content contentresult"><h4>LA Wolves FC</h4>

                            <p>Lose</p>

                            <p>Leland Lagos (29)</p> </div>
                        <div class="figure figresult">
                            <div class=team-logo>
                                <div style="background-image: url(<?php echo base_url();?>assets/front/images/team-logo/logo02.png)" class=teamLogoImg></div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    <?php } else { ?>
    <section class=latestResult>
        <div class=container>
            <div class=row><h2 class=heading>latest <span>result</span></h2>

                <div class=latestResult-wrap><h4><?php echo $latest_result[0]['match_type']?></h4>

                    <p>Sponsored by Nifty Services</p></div>
                <div class="result clearfix">
                    <div class=result-details>
                        <div class=content><h4>LA Aztecs</h4>

                            <p><?php echo $latest_result[0]['match_result']?></p>
                            <!-- <?php
                            $own_goalers = unserialize($latest_result[0]['own_goaler']); 
                            foreach($own_goalers as $own_goaler) { ?>
                            <p><?php echo $own_goaler['goal_info']?></p>
                            <?php } ?> -->
                        </div>
                           
                        <div class=figure>
                            <div class=team-logo>
                                <div style="background-image: url(<?php echo base_url();?>assets/front/images/team-logo/logo01.png)" class=teamLogoImg></div>
                            </div>
                        </div>
                    </div>
                    <div class=result-count>
                        <div class=count-number><span class=lose-team><?php echo $latest_result[0]['own_goals']?></span> <span>-</span> <span
                                class=win-team><?php echo $latest_result[0]['competitor_goals']?></span></div>
                        <div class=dateTime>
                            <?php $date = date_create($latest_result[0]['match_time']);?> 
                            <div class=dateTime-container><span class=date><?php echo date_format($date, 'M d\, Y');?></span> <span
                                    class=time><?php echo date_format($date, 'g:ia');?></span></div>
                            <div class=country-wrap><span class=field><?php echo $latest_result[0]['match_location']?></span> 
                            </br><span class=country>(Los Angeles)</span>
                            </div>
                        </div>
                    </div>
                    <div class=result-details>
                        <div class="content contentresult">
                            <h4>
                            <?php
                            foreach ($teams as $team) { 
                                if ($latest_result[0]['team_id'] == $team['id']) { 
                                    echo $team['team_name'];
                                }
                            }?>
                            </h4>
                            <?php
                            if($latest_result[0]['own_goals'] > $latest_result[0]['competitor_goals']) { ?>
                            <p>Lose</p>
                            <?php
                            } elseif ($latest_result[0]['own_goals'] < $latest_result[0]['competitor_goals']) { ?>
                            <p>Win</p>
                            <?php
                            } else { ?>
                            <p>Draw</p>
                            <?php } ?>
                            <!-- <?php
                            $competitor_goalers = unserialize($latest_result[0]['competitor_goaler']); 
                            foreach($competitor_goalers as $competitor_goaler) { ?>
                            <p><?php echo $competitor_goaler['goal_info']?></p>
                            <?php } ?> -->
                        </div>
                        <div class="figure figresult">
                            <div class=team-logo>
                                <?php
                                foreach ($teams as $team) { 
                                    if ($latest_result[0]['team_id'] == $team['id']) { ?>
                                <div style="background-image: url(<?php echo base_url() . $team['team_logo'];?>)" class=teamLogoImg></div>
                                <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    <?php } ?>

    
    <section class=matchSchedule>
        <div class=container>
            <div class=row><h2 class=heading>Next &nbsp;<span>Game</span></h2>
                <?php if (!($oldest_schedule)) { ?>
                <div class="matchSchedule_details row">
                    <div class="match_next right-triangle">
                        <div class="wrap_match_next right-triangle">
                            <div class=right-padding><h4 class=headline03>Match Up</h4>

                                <p>LA Aztecs VS Chivas</p></div>
                        </div>
                    </div>
                    <div class=match_versus>
                        <div class="bg-blackimg match_versus02">
                            <div class=nextmatchDetails>
                                </br>
                                </br>
                                </br>
                                

                                <div class="wrap-logo clearfix">
                                    <div class=logo-match><img src=<?php echo base_url();?>assets/front/images/matchResult/logo01.png alt=image></div>
                                    <div class=match_vs>vs</div>
                                    <div class=logo-match><img src=<?php echo base_url();?>assets/front/images/matchResult/logo02.png alt=image></div>
                                </div>
                                <p class=match_dtls>October 5, 2019 | 1:25PM</p>

                                <p class=match_dtls>Salesian Stadium (Los Angeles)</p></div>
                        </div>
                    </div>
					<div>
                 <center>
                     <ul>     
                    <li><h2>Sponsors</h2>
                        <ul class=widget_productdetails>
                            <li><a href=#>Invictvs</a></li>
                            <li><a href=#>Rebel Radio X</a></li>
                            <li><a href=#>Loral Records</a></li>
                            <li><a href=#>Nifty Services</a></li>
                            <li><a href="#">Urbanradiox</a></li>
                        </ul>
                    </li>
					</ul>
                        </br>
                        <center><a href="#">Become A Sponsor</a></center>
                   </center>
				   </div>
                </div>
                <?php } else { ?>
                <div class="matchSchedule_details row">
                    <div class="match_next right-triangle">
                        <div class="wrap_match_next right-triangle">
                            <div class=right-padding><h4 class=headline03>Match Up</h4>

                                <p>LA Aztecs VS 
                            <?php
                            foreach ($teams as $team) { 
                                if ($oldest_schedule[0]['team_id'] == $team['id']) { 
                                    echo $team['team_name'];
                                }
                            }?></p></div>
                        </div>
                    </div>
                    <div class=match_versus>
                        <div class="bg-blackimg match_versus02">
                            <div class=nextmatchDetails>
                                </br>
                                </br>
                                </br>
                                

                                <div class="wrap-logo clearfix">
                                    <div class=logo-match><img src=<?php echo base_url();?>assets/front/images/matchResult/logo01.png width=100% alt=image></div>
                                    <div class=match_vs>vs</div>
                                    <div class=logo-match>
                                        <?php
                                        foreach ($teams as $team) { 
                                            if ($oldest_schedule[0]['team_id'] == $team['id']) { ?>
                                        <img src=<?php echo base_url() . $team['team_logo'];?> width=100% alt=image></div>
                                        <?php }
                                        } ?>
                                        </div>
                                </div>
                                <?php $date = date_create($oldest_schedule[0]['match_time']);?>
                                <p class=match_dtls><?php echo date_format($date, 'M d\, Y');?> | <?php echo date_format($date, 'g:ia');?></p>

                                <p class=match_dtls><?php echo $oldest_schedule[0]['match_location']?> (Los Angeles)</p></div>
                        </div>
                    </div>
                    <div>
                 <center>
                     <ul>     
                    <li><h2>Sponsors</h2>
                        <ul class=widget_productdetails>
                            <li><a href=#>Invictvs</a></li>
                            <li><a href=#>Rebel Radio X</a></li>
                            <li><a href=#>Loral Records</a></li>
                            <li><a href=#>Nifty Services</a></li>
                            <li><a href="#">Urbanradiox</a></li>
                        </ul>
                    </li>
                    </ul>
                        </br>
                        <center><a href="#">Become A Sponsor</a></center>
                   </center>
                   </div>
                </div>
                <?php } ?>

                <?php if (!($standings)) { ?>
                <div class="matchSchedule_details row">
                    <div class=match_next>
                        <div class="wrap_match_next right-triangle">
                            <div class=right-padding><h4 class=headline03>Standings</h4>

                                <p>Table</p></div>
                        </div>
                    </div>
                    <div class=match_versus-wrap>
                        <div class=wrap_match-innerdetails>
                            <ul class="point_table scrollable">
                                <li class=clearfix>
                                    <div class=subPoint_table>      
                                        <div class="headline01 smallpoint">1</div>
                                        <div class="headline01 largepoint">LA Aztecs</div>
                                        <div class="headline01 smallpoint row row"><span>p</span><span>14</span></div>
                                    </div>
                                </li>
                                <li class=clearfix>
                                    <div class=subPoint_table>
                                        <div class="headline01 smallpoint">2</div>
                                        <div class="headline01 largepoint">FC Spinning Slammers</div>
                                        <div class="headline01 smallpoint row"><span>p</span><span>10</span></div>
                                    </div>
                                </li>
                                <li class=clearfix>
                                    <div class=subPoint_table>
                                        <div class="headline01 smallpoint">3</div>
                                        <div class="headline01 largepoint">FC Crimson Executioners</div>
                                        <div class="headline01 smallpoint row"><span>p</span><span>10</span></div>
                                    </div>
                                </li>
                                <li class=clearfix>
                                    <div class=subPoint_table>
                                        <div class="headline01 smallpoint">4</div>
                                        <div class="headline01 largepoint">FC Shaolin Robots</div>
                                        <div class="headline01 smallpoint row"><span>p</span><span>10</span></div>
                                    </div>
                                </li>
                                <li class=clearfix>
                                    <div class=subPoint_table>
                                        <div class="headline01 smallpoint">5</div>
                                        <div class="headline01 largepoint">FC Silent Xpress</div>
                                        <div class="headline01 smallpoint row"><span>p</span><span>10</span></div>
                                    </div>
                                </li>
                                <li class=clearfix>
                                    <div class=subPoint_table>
                                        <div class="headline01 smallpoint">6</div>
                                        <div class="headline01 largepoint">FC Dark Scorpions</div>
                                        <div class="headline01 smallpoint row"><span>p</span><span>10</span></div>
                                    </div>
                                </li>
                                <li class=clearfix>
                                    <div class=subPoint_table>
                                        <div class="headline01 smallpoint">7</div>
                                        <div class="headline01 largepoint">FC Cyborg Snakes</div>
                                        <div class="headline01 smallpoint row"><span>p</span><span>10</span></div>
                                    </div>
                                </li>
                                <li class=clearfix>
                                    <div class=subPoint_table>
                                        <div class="headline01 smallpoint">8</div>
                                        <div class="headline01 largepoint">FC Skull Killers</div>
                                        <div class="headline01 smallpoint row"><span>p</span><span>10</span></div>
                                    </div>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
                <?php } else { ?>
                <div class="matchSchedule_details row">
                    <div class=match_next>
                        <div class="wrap_match_next right-triangle">
                            <div class=right-padding><h4 class=headline03>Standings</h4>

                                <p>Table</p></div>
                        </div>
                    </div>
                    <div class=match_versus-wrap>
                        <div class=wrap_match-innerdetails>
                            <ul class="point_table scrollable">
                                <?php
                                    $index = 1;
                                    foreach ($standings as $standing) {
                                ?>
                                <li class=clearfix>
                                    <div class=subPoint_table>      
                                        <div class="headline01 smallpoint"><?php echo $index;?></div>
                                        <div class="headline01 largepoint"><?php echo $standing['team_name']?></div>
                                        <div class="headline01 smallpoint row row"><span>p</span><span><?php echo $standing['team_point']?></span></div>
                                    </div>
                                </li>
                                <?php
                                        $index++;
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <section class="booking bookticket">
        <div class=container>
            <div class=booking-fig><h2>Los Angeles Aztecs</h2></div>
            <div class=booking-content><a href=<?php echo base_url();?>academy class="btn btn-white">Join the Academy</a></div>
        </div>
    </section>

    <section class=latestvideo>
        <div class=container>
            <div class=row><h2 class=heading>latest <span>video</span></h2>

                <p class=headParagraph>Los Angeles Aztecs Video</p>
                
                    <div class=video-show>
                        <div class=video-container id=video01 data-current-video=W7qWa52k-nE>
                                 <center>
                                    <video width="100%" height="auto" bgcolor="#E6E6FA" controls>
                                        <source src="<?php echo base_url();?>assets/front/video/LA Aztec promo video.mp4" type="video/mp4">
                                    </video>
                                </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if (!($latest_news)) { ?>
    <section class="latest_news bg-white">
        <div class=container>
            <div class=row><h2 class=heading>latest <span>news</span></h2>

                <p class=headParagraph>La Aztecs New Signing</p>
                
                <center>
                    <div class=playerFig>
                        <div class=playerpic>
                            <div style="background-image: url(<?php echo base_url();?>assets/front/images/player/player05.jpg)" class=bgimg></div>
                        </div>
                        <ul class="playerDetails clearfix">
                            <!-- <li><span>Dominick Dumbleton</span> <span><img src=<?php echo base_url();?>assets/front/images/icons/tShirt.png alt=image></span></li> -->
                            <li><span>Dominick Dumbleton</span></li>
                            <li class=playinfodetails>age 28 (born 22 april ,1987)</li>
                            <!-- <li class=playerInfo><span>STRIKER</span> <span>Signed October 12, 2019</span> -->
                            </li>
                        </ul>
                    </div>
                </center>
            </div>
        </div>
    </section>
    <?php } else { ?>
    <section class="latest_news bg-white">
        <div class=container>
            <div class=row><h2 class=heading>latest <span>news</span></h2>

                <p class=headParagraph><?php echo $latest_news[0]['news_title'] ?></p>
                
                <center>
                    <div class=playerFig>
                        <div class=playerpic>
                            <!-- <div style="background-image: url(<?php echo base_url() . $latest_news[0]['news_logo'];?>)"></div> -->
                            <img src="<?php echo base_url() . $latest_news[0]['news_logo']; ?>" width="100%" height="100%" alt="" />
                        </div>
                        <ul class="playerDetails clearfix">
                            <!-- <li><span>Dominick Dumbleton</span> <span><img src=<?php echo base_url();?>assets/front/images/icons/tShirt.png alt=image></span></li> -->
                            <li><span><?php echo $latest_news[0]['news_title'] ?></span></li>
                            <li class=playinfodetails><?php echo $latest_news[0]['news_content'] ?></li>
                            <!-- <li class=playerInfo><span>STRIKER</span> <span>Signed October 12, 2019</span> -->
                            </li>
                        </ul>
                    </div>
                </center>
            </div>
        </div>
    </section>
    <?php } ?>
    
    
    <section class=social-media>
        <div class=container>
            <div class=row>
                <ul class=socialinfo>
                    <li><a href="#">
                        <div class=sociallink><i class="fa fa-twitter"></i></div>
                        <p>LA Aztecs 1</p></a></li>
                    <li><a href="#">
                        <div class=sociallink><i class="fa fa-facebook"></i></div>
                        <p>LA Aztecs 2</p></a></li>
                    <li><a href="#">
                        <div class=sociallink><i class="fa fa-youtube"></i></div>
                        <p>LA Aztecs 3</p></a></li>
                </ul>
            </div>
        </div>
    </section>
 
    <section class="product bg-white">
        <div class=container>
            <div class=row><h2 class=heading>TOP PRODUCTS & <span>merchandise</span></h2>

                <p class=headParagraph>Merch 1.</p>
                
                <?php if (count($products)) { ?>
                    <ul class=product_details>
                    <?php foreach($products as $key => $product) { ?>
                        <li>
                            <a href=<?php echo base_url();?>shop/product_details/<?php echo $product['id']?>>
                                <div>
                                    <div class=product-img
                                         style="background: url(<?php echo base_url() . $product['product_image'];?>) center no-repeat; cursor: pointer;"></div>
                                </div>
                            </a>
                                <ul class="oswald16 product_info">
                                    <li class=detailsContainer style="text-align: center;"><center><?php echo $product['product_name']?></center></li>
                                    <li class="cartContainer addToCart" data-productid="<?php echo $product['id']?>" data-productname="<?php echo $product['product_name']?>" data-productprice="<?php echo $product['product_price']?>" data-productimage="<?php echo base_url() . $product['product_image'];?>" style="cursor: pointer;"><span>Add to cart</span> <span><i
                                            class="fa fa-shopping-cart"></i></span> <span class=price>$<?php echo $product['product_price']?></span></li>
                                </ul>
                            
                        </li>
                    <?php } ?>
                    </ul>
                <?php } else { ?>
                <ul class=product_details>
                    <li><a href=#>
                        <div>
                            <div class=product-img
                                 style="background: url(<?php echo base_url();?>assets/front/images/product/product01.jpg) center no-repeat;"></div>
                        </div>
                        <ul class="oswald16 product_info">
                            <li class=detailsContainer><span>soccer jersey</span> <span><i
                                    class="fa fa-user"></i>360</span></li>
                            <li class=cartContainer><span>Add to cart</span> <span><i
                                    class="fa fa-shopping-cart"></i></span> <span class=price>$199</span></li>
                        </ul>
                    </a></li>
                    <li><a href=#>
                        <div>
                            <div class=product-img
                                 style="background: url(<?php echo base_url();?>assets/front/images/product/product02.jpg) center no-repeat"></div>
                        </div>
                        <ul class="oswald16 product_info">
                            <li class=detailsContainer><span>soccer jersey</span> <span><i
                                    class="fa fa-user"></i>360</span></li>
                            <li class=cartContainer><span>Add to cart</span> <span><i
                                    class="fa fa-shopping-cart"></i></span> <span class=price>$199</span></li>
                        </ul>
                    </a></li>
                    <li><a href=#>
                        <div>
                            <div class=product-img
                                 style="background: url(<?php echo base_url();?>assets/front/images/product/product03.jpg) center no-repeat"></div>
                        </div>
                        <ul class="oswald16 product_info">
                            <li class=detailsContainer><span>soccer jersey</span> <span><i
                                    class="fa fa-user"></i>360</span></li>
                            <li class=cartContainer><span>Add to cart</span> <span><i
                                    class="fa fa-shopping-cart"></i></span> <span class=price>$199</span></li>
                        </ul>
                    </a></li>
                    <li><a href=#>
                        <div>
                            <div class=product-img
                                 style="background:url(<?php echo base_url();?>assets/front/images/product/product04.jpg) center no-repeat"></div>
                        </div>
                        <ul class="oswald16 product_info">
                            <li class=detailsContainer><span>soccer jersey</span> <span><i
                                    class="fa fa-user"></i>360</span></li>
                            <li class=cartContainer><span>Add to cart</span> <span><i
                                    class="fa fa-shopping-cart"></i></span> <span class=price>$199</span></li>
                        </ul>
                    </a></li>
                </ul>
                <?php } ?>
                <div class=center><a href=<?php echo base_url();?>shop class="btn btn-red">view more</a></div>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <footer class=footer-type01>