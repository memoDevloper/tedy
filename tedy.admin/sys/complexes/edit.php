<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">مدينة <?php echo $city->name_ar; ?></h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="/complexes" class="CPB" >المجمعات السكنية</a></li>
                <li><a href="/complexes/city/<?php  echo $city->id;?>" class="backButton CPB" ><?php echo $city->name_ar; ?></a></li>
                <li class="active">تعديل مجمع</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="white-box">
                <form class="form-horizontal form-material form" autocomplete="off">
                    <input type="hidden" name="actionName" value="EDIT_COMPLEX">
                    <input type="hidden" name="id" value="<?php echo $complex->id; ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-12" for="delivery_time_type">التسليم</label>
                                <div class="col-sm-12">
                                    <select class="form-control form-control-line delivery_time_type" id="delivery_time_type" name="delivery_time_type">
                                        <option value="1" <?php echo ($complex->delivery_time_type == 1) ? 'selected' : ''; ?> >فوري</option>
                                        <option value="2" <?php echo ($complex->delivery_time_type == 2) ? 'selected' : ''; ?> >تاريخ معين</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-12" for="delivery_time">تاريخ التسليم</label>
                                <div class="col-md-12">
                                    <input type="text" name="delivery_time" class="form-control form-control-line delivery_time input-timepicker" id="delivery_time" placeholder="تاريخ التسليم" value="<?php echo date('Y-m-d', $complex->delivery_time); ?>" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-12" for="currency">العملة</label>
                                <div class="col-sm-12">
                                    <select class="form-control form-control-line currency" id="currency" name="currency">
                                        <?php
                                        $currencies = $wam->dbm->getData('currencies', ['code', 'name_ar as name', 'icon']);
                                        foreach ($currencies as $currency){
                                            ?>
                                            <option value="<?php echo $currency->code ?>" <?php echo ($complex->currency == $currency->code) ? 'selected' : ''; ?> ><?php echo $currency->name; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-12" for="area">مساحة المجمع</label>
                                <div class="col-md-12">
                                    <input type="text" name="area" class="form-control form-control-line area" id="area" placeholder="مساحة المجمع" value="<?php echo $complex->area; ?>" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-12" for="buildings">عدد الأبنية</label>
                                <div class="col-md-12">
                                    <input type="text" name="buildings" class="form-control form-control-line buildings" id="buildings" placeholder="عدد الأبنية" value="<?php echo $complex->buildings; ?>" >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-12" for="realestates">عدد العقارات</label>
                                <div class="col-md-12">
                                    <input type="text" name="realestates" class="form-control form-control-line realestates" id="realestates" placeholder="عدد العقارات" value="<?php echo $complex->realestates; ?>" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-12" for="dues">العائدات</label>
                                <div class="col-md-12">
                                    <input type="text" name="dues" class="form-control form-control-line dues" id="dues" placeholder="العائدات" value="<?php echo $complex->dues; ?>" step="0.5" >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-12" for="heating">التدفئة</label>
                                <div class="col-sm-12">
                                    <select class="form-control form-control-line heating" id="heating" name="heating">
                                        <?php
                                        foreach ($realestate_heating as $key => $name){
                                            ?>
                                            <option value="<?php echo $key ?>" <?php echo ($complex->heating == $key) ? 'selected' : ''; ?> ><?php echo $name; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-12" for="city">المدينة</label>
                                <div class="col-sm-12">
                                    <select class="form-control form-control-line city" id="city" name="city">
                                        <?php
                                        $cities = $wam->dbm->getData('cities', ['id', 'name_ar'], ['order' => ['id']]);
                                        foreach ($cities as $key => $city){
                                            ?>
                                            <option value="<?php echo $city->id; ?>" <?php echo ($complex->city == $city->id) ? 'selected' : ''; ?> ><?php echo $city->name_ar; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-12" for="district">المنطقة</label>
                                <div class="col-sm-12">
                                    <select class="form-control form-control-line district" id="district" name="district">
                                        <?php
                                        $districts = $wam->dbm->getData('districts', ['id', 'name_tr'], ['eq' => ['city' => $complex->city], 'order' => ['id']]);
                                        foreach ($districts as $key => $district){
                                            ?>
                                            <option value="<?php echo $district->id; ?>" <?php echo ($complex->district == $district->id) ? 'selected' : ''; ?> ><?php echo $district->name_tr; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-12" for="citizenship_cover">صورة الجنسية <?php echo $complex->citizenship_cover ? "(<a href='$complex->citizenship_cover' target='_blank'>فتح</a>)" : ''; ?></label>
                                <div class="col-md-12">
                                    <input type="file" name="citizenship_cover" class="form-control form-control-line citizenship_cover" id="citizenship_cover" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <style>
                            #detecting-map {
                                height: 400px;
                                margin: 0;
                                padding: 0;
                            }
                            .centerMarker{
                                position:absolute;
                                /*url of the marker*/
                                background:url(https://maps.gstatic.com/mapfiles/markers2/marker.png) no-repeat;
                                /*center the marker*/
                                top:50%;left:50%;

                                z-index:1;
                                /*fix offset when needed*/
                                margin-left:-10px;
                                margin-top:-34px;
                                /*size of the image*/
                                height:34px;
                                width:20px;
                                cursor:pointer;
                            }
                        </style>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="map_lat">Latitude</label>
                                <input type="text" class="form-control form-control-line map_lat" name="lat" id="map_lat" value="<?php echo $complex->lat ?>">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="map_lng">Longitude</label>
                                <input type="text" class="form-control form-control-line map_lng" name="lng" id="map_lng" value="<?php echo $complex->lng ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div style="position: relative;" >
                                <div class="centerMarker"></div>
                                <div id="detecting-map"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="location_url">Location URL</label>
                                <input type="text" class="form-control form-control-line location_url" name="location_url" id="location_url">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group" >
                                <input type="checkbox" class="js-switch" name="citizenship" id="citizenship" <?php echo ($complex->citizenship) ? 'checked' : ''; ?> data-color="#f96262" />
                                <label for="citizenship" >مناسب للجنسية التركية</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" >
                                <input type="checkbox" class="js-switch" name="slider" id="slider" <?php echo ($complex->slider) ? 'checked' : ''; ?> data-color="#f96262" />
                                <label for="slider" >اتاحة في السلايدر الرئيسي</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" >
                                <input type="checkbox" class="js-switch" name="citizenship_slider" <?php echo ($complex->citizenship_slider) ? 'checked' : ''; ?> id="citizenship_slider" data-color="#f96262" />
                                <label for="citizenship_slider" >اتاحة في سلايدر الجنسية</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" >
                                <input type="checkbox" class="js-switch" name="featured" id="featured" <?php echo ($complex->featured) ? 'checked' : ''; ?> data-color="#f96262" />
                                <label for="featured" >مشروع مميز</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" >
                                <input type="checkbox" class="js-switch" name="map" id="map" <?php echo ($complex->map) ? 'checked' : ''; ?> data-color="#f96262" />
                                <label for="map" >الخريطة</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" >
                                <input type="checkbox" class="js-switch" name="sold" id="sold" <?php echo ($complex->sold) ? 'checked' : ''; ?> data-color="#f96262" />
                                <label for="sold" >المشروع مباع</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4>أنواع العقارات</h4>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        $types = explode('[//]', $complex->type);
                        foreach ($complexes_types as $key => $complexes_type){
                            ?>
                            <div class="col-md-3">
                                <div class="form-group" >
                                    <input type="checkbox" class="js-switch" name="types[]" id="type_<?php echo $key ?>" value="<?php echo $key; ?>" <?php echo (in_array($key, $types)) ? 'checked' : ''; ?> data-color="#f96262" />
                                    <label for="type_<?php echo $key ?>" ><?php echo $complexes_type ?></label>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4>مميزات المشروع</h4>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        $features = $wam->dbm->getData('realestate_features', [
                            'id',
                            'name_ar as name'
                        ], [
                            'order' => ['name_ar']
                        ]);
                        $featuresList = explode('[//]', $complex->features);
                        foreach ($features as $key => $feature){
                            ?>
                            <div class="col-md-3">
                                <div class="form-group" >
                                    <input type="checkbox" class="js-switch" name="features[]" id="feature_<?php echo $feature->id ?>" value="<?php echo $feature->id; ?>" <?php echo (in_array($feature->id, $featuresList)) ? 'checked' : ''; ?> data-color="#f96262" />
                                    <label for="feature_<?php echo $feature->id ?>" ><?php echo $feature->name ?></label>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success">تعديل</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>