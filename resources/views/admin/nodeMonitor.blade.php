@extends('admin.layouts')

@section('css')
@endsection

@section('title', '控制面板')
@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE BREADCRUMB -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="{{url('admin/nodeList')}}">节点管理</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{url('admin/nodeList')}}">节点列表</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{url('admin/nodeMonitor')}}">节点流量监控</a>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-body">
                        <div id="chart1" style="width: auto;height:450px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-body">
                        <div id="chart2" style="width: auto;height:450px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT BODY -->
@endsection
@section('script')
    <script src="/assets/global/plugins/echarts/echarts.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        var myChart = echarts.init(document.getElementById('chart1'));

        option = {
            title: {
                text: '24小时内流量',
                subtext: '单位M'
            },
            tooltip: {
                trigger: 'axis'
            },
            toolbox: {
                show: true,
                feature: {
                    saveAsImage: {}
                }
            },
            xAxis: {
                type: 'category',
                boundaryGap: false,
                data: ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24']
            },
            yAxis: {
                type: 'value',
                axisLabel: {
                    formatter: '{value} M'
                }
            },
            series: [
                @if(!empty($trafficHourly))
                    {
                        name:'{{$trafficHourly['nodeName']}}',
                        type:'line',
                        data:[{!! $trafficHourly['hourlyData'] !!}],
                        markPoint: {
                            data: [
                                {type: 'max', name: '最大值'}
                            ]
                        }
                    }
                @endif
            ]
        };

        myChart.setOption(option);
    </script>

    <script type="text/javascript">
        var myChart = echarts.init(document.getElementById('chart2'));

        option = {
            title: {
                text: '30日内流量',
                subtext: '单位M'
            },
            tooltip: {
                trigger: 'axis'
            },
            toolbox: {
                show: true,
                feature: {
                    saveAsImage: {}
                }
            },
            xAxis: {
                type: 'category',
                boundaryGap: false,
                data: ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30']
            },
            yAxis: {
                type: 'value',
                axisLabel: {
                    formatter: '{value} M'
                }
            },
            series: [
                @if(!empty($trafficDaily))
                    {
                        name:'{{$trafficDaily['nodeName']}}',
                        type:'line',
                        data:[{!! $trafficDaily['dailyData'] !!}],
                        markPoint: {
                            data: [
                                {type: 'max', name: '最大值'}
                            ]
                        }
                    }
                @endif
            ]
        };

        myChart.setOption(option);
    </script>
@endsection