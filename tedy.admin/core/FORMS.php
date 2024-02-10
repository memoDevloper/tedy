<?php

class FORMS{
	public function __construct() {
		global $dir1, $dir2, $dir3, $dir4, $dir5, $dir6;
		$this->dir1 = $dir1;
		$this->dir2 = $dir2;
		$this->dir3 = $dir3;
		$this->dir4 = $dir4;
		$this->dir5 = $dir5;
		$this->dir6 = $dir6;
	}
	public function realestateGrid($items){
		foreach ($items as $key => $item) {
			$agency_whatsapp = (int) str_replace(['+', ' ', '(', ')'], '', $item->whatsapp);
			$price = number_format($item->price);
			$view_details = _VIEW_DETAILS_;
			$whatsapp = _WHATSAPP_;
			$call_now = _CALL_NOW_;
			$lang = ($this->dir1 !== 'ajax') ? $this->dir1 : $this->dir3;
			echo <<<EOT
			<div class="col-md-4 col-xs-12 col-sm-6">
				<div class="category-grid-box">
					<a href="/$lang/property/$item->id" >
						<div class="category-grid-img" style="background-image: url(/images/?img=$item->photo&type=icon&size=350);" >
							<div class="user-preview">
								<img src="$item->agency_logo" class="avatar avatar-small" alt="">
							</div>
							<span class="view-details" >$view_details</span>
						</div>
						<div class="short-description">
							<div class="category-title"> <span>$item->agency_name</span> </div>
							<h3>$item->name</h3>
							<div class="price">$price</div>
						</div>
					</a>
					<div class="ad-info-1">
						<ul>
							<li style="width: 50%;" class="whatsapp-color" ><a href="https://api.whatsapp.com/send?phone=$agency_whatsapp" ><i class="fa fa-whatsapp"></i> $whatsapp</a></li>
							<li style="width: 50%;" class="phone-color" ><a href="tel:$item->phone" ><i class="flaticon-smartphone"></i> $call_now</a></li>
						</ul>
					</div>
				</div>
			</div>
EOT;
		}
	}

	public function realestateList($items){
		foreach ($items as $key => $item) {
			$agency_whatsapp = (int) str_replace(['+', ' ', '(', ')'], '', $item->whatsapp);
			$price = number_format($item->price);
			$view_details = _VIEW_DETAILS_;
			$whatsapp = _WHATSAPP_;
			$call_now = _CALL_NOW_;
			$lang = ($this->dir1 !== 'ajax') ? $this->dir1 : $this->dir3;
			echo <<<EOT
			<div class="ads-list-archive">
				<div class="col-lg-4 col-md-4 col-sm-5 no-padding">
					<div class="ad-archive-img">
						<a href="/$lang/property/$item->id">
							<img class="img-responsive" src="/images/?img=$item->photo&type=icon&size=256" alt="$item->name">
						</a>
					</div>
				</div>
				<div class="clearfix visible-xs-block"></div>
				<div class="col-lg-8 col-md-8 col-sm-7 no-padding">
					<div class="ad-archive-desc">
						<img alt="$item->agency_name" class="pull-right" src="$item->agency_logo" width="60">
						<h3><a href="/$this->dir1/property/$item->id" >$item->name</a></h3>
						<div class="category-title"> <span><a href="/$this->dir1/agency/$item->agency">$item->agency_name</a></span> </div>
						<div class="clearfix visible-xs-block"></div>
						<div class="ad-price-simple">$price</div>
						<div class="clearfix archive-history">
							<div class="ad-meta">
								<a href="tel:$item->phone"  class="btn save-ad phone-color"><i class="flaticon-smartphone"></i> $call_now</a>
								<a href="https://api.whatsapp.com/send?phone=$agency_whatsapp" class="btn btn-success"><i class="fa fa-whatsapp"></i> $whatsapp</a>
							</div>
						</div>
					</div>
				</div>
			</div>
EOT;
		}
	}
}
