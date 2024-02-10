<div class="modal-header">
    <div class="row" >
        <div class="col-xs-12" >
            <div class="pull-left" >
                <h4>اضافة مكتب جديد</h4>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
    </div>
</div>
<form class="form-horizontal form-material form" autocomplete="off" >
    <input type="hidden" name="actionName" value="NEW_OFFICE" />
    <div class="modal-body">
        <div class="row" >
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="name">الاسم</label>
                    <div class="col-md-12">
                        <input type="text" name="name" class="form-control form-control-line name" id="name" placeholder="الاسم" />
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="lat">خط العرض</label>
                    <div class="col-md-12">
                        <input type="text" name="lat" class="form-control form-control-line lat" id="lat" placeholder="خط العرض" />
                    </div>
                </div>
            </div>
            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-md-12" for="lng">خط الطول</label>
                    <div class="col-md-12">
                        <input type="text" name="lng" class="form-control form-control-line lng" id="lng" placeholder="خط الطول" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success waves-effect waves-light" >اضافة</button>
        <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal" aria-hidden="true">الغاء</button>
    </div>
</form>