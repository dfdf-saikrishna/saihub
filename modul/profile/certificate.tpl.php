<?php
$userId = getuserId();
?>
<div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Download Certificate
                        </header>
                        <div class="panel-body" height="600px">
						<div><img src=".\..\assets\images\certificate.jpg" width="980px"></div>
						<!-- Serial No -->
						<div style="position: absolute; top: 638px; left: 660px; font-size: 20px; text-align: center; display: block; font-weight: bold; width: 300px; font-family: serif; color: #f00;">
						<strong><?php echo sprintf('%08d', $userId[0]['uid']); ?></strong>
						</div>
						
						<!-- Full name -->
						<div style=" position: absolute; top: 750px; left: 350px; font-size:20px; text-align: center; display: block; font-weight: bold; width: 300px;   HEIGHT: 30PX;     color: #333;
    font-family: serif;">
						<strong><?php echo $userId[0]['first_name'] . " " . $userId[0]['last_name']; ?></strong>
						</div>
						
						<!-- Donation Amount -->
						<div style="position: absolute; top: 950px; left: 420px; font-size: 28px; text-align: center; display: block; font-weight: bold; width: 150px; height: 30PX; font-family: serif; color: #000;">
						<strong><?php echo $userId["product"][0]["value"];?></strong>
						</div>
						
						<!-- Joining Date -->
						<div style="position: absolute; top: 950px; left: 650px; font-size: 20px; text-align: center; display: block; font-weight: bold;  height: 30PX; font-family: serif; color: #000;">
						<strong><?php 
						$yrdata= strtotime($userId["user"][0]["register_date"]);
						echo date('d M Y', $yrdata);
						?></strong>
						</div>
                        </div>
                    </section>
                </div>
            </div>
