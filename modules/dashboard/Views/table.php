<!--begin::Row-->
<div class="row g-5 gx-xxl-8 mb-xxl-3 p-5">
    <!--begin::Col-->
    <div class="col-xxl-8">
        <!--begin::Chart Widget 1-->
        <div class="card card-xxl-stretch mb-5 mb-xxl-8">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-5">
                <!--begin::Card title-->
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-boldest fs-3 text-dark" id="displayHai">Hai,</span>
                    <span class="text-info mt-2 fw-bold fs-6">Berikut rekap Penjualan Do'a Ibu Coffee</span>
                </h3>
                <!--end::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Header-->
            <!--begin::Card body-->
            <div class="card-body p-5">
                <!--begin::Tab content-->
                <div class="tab-content pt-10">
                    <!--begin::Tap pane-->
                    <div class="tab-pane fade active show" id="kt_chart_widget_1_tab_pane_1">
                        <!--begin::Row-->

                        <!--end::Row-->
                        <form action="javascript:filterChartRekap()" method="post" id="form-filterRekap" name="form-filterRekap" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-body mx-20">
                                <div class="col-md-12 row">
                                    <div class="col-md-3">
                                        <label for="filterRekap">Filter Tanggal Transaksi</label>
                                        <input type="text" class="form-control form-control-sm" id="filterRekap" />
                                    </div>
                                    <div class="col-md-2 mt-6">
                                        <button type="submit" class="btn btn-sm btn-primary" id="btn-save" style="width: 100%;"><i class="fa fa-filter"></i>Filter</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--begin::Chart-->
                        <canvas class="px-4 mt-7" id="chartSales" style="width: 100%;height: 300px;">

                        </canvas>
                        <!--end::Chart-->
                    </div>
                </div>
                <!--end::Tab content-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Chart Widget 1-->
    </div>
    <!--end::Col-->
</div>
<!--end::Row-->
<!--Begin::Row-->
<div class="row g-5 gx-xxl-8 mb-xxl-3 p-5">
    <!--begin::Col-->
    <div class="col-xxl-8">
        <div class="card card-xxl-stretch mb-5 mb-xxl-8">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-boldest fs-3 text-dark">Best Sellers</span>
                </h3>
                <div class="card-toolbar">

                </div>
            </div>
            <div class="card-body p-5">
                <div class="tab-content pt-10">
                    <div class="tab-pane fade active show" id="kt_chart_widget_1_tab_pane_1">
                        <!--begin::Row-->
                        <!--end::Row-->
                        <!-- <form action="javascript:filterChartRekap()" method="post" id="form-filterRekap" name="form-filterRekap" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-body mx-20">
                                <div class="col-md-5">
                                    <input type="text" class="" id="filterRekap" />
                                </div>
                                <div class="col-md-5">
                                    <button type="submit" class="btn btn-success" id="btn-save" style="width: 100%;"><i class="fa fa-save"></i>Filter</button>
                                </div>
                            </div>
                        </form> -->
                        <!--begin::Chart-->
                        <canvas class="px-4 mt-7" id="chartBS" style="width: 100%;height: 300px;">

                        </canvas>
                        <!--end::Chart-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End::Row-->
<!--Begin::Row-->


<?php echo view('../../modules/dashboard/Views/javascript') ?>
<!--End::Row-->