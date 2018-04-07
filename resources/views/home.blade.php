@extends('layouts.app') 
@section('title', __('Summary'))

@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">
            {{ __('Summary') }}
        </h1>
    </div>
    <div class="row row-cards">

        <!-- First row -->
        <div class="col-sm-6 col-lg-3">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <span class="stamp stamp-md bg-blue mr-3">
                            <i class="fe fe-credit-card"></i>
                        </span>
                        <div>
                            <h4 class="m-0">
                                <a href="javascript:void(0)">132
                                    <small>{{ __('Accounts') }}</small>
                                </a>
                            </h4>
                            <small class="text-muted">12 waiting payments</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <span class="stamp stamp-md bg-green mr-3">
                            <i class="fe fe-database"></i>
                        </span>
                        <div>
                            <h4 class="m-0">
                                <a href="javascript:void(0)">78
                                    <small>{{ __('Data') }}</small>
                                </a>
                            </h4>
                            <small class="text-muted">32 shipped</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <span class="stamp stamp-md bg-red mr-3">
                            <i class="fe fe-upload"></i>
                        </span>
                        <div>
                            <h4 class="m-0">
                                <a href="javascript:void(0)">1,352
                                    <small>{{ __('Debit Data') }}</small>
                                </a>
                            </h4>
                            <small class="text-muted">163 registered today</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <span class="stamp stamp-md bg-yellow mr-3">
                            <i class="fe fe-download"></i>
                        </span>
                        <div>
                            <h4 class="m-0">
                                <a href="javascript:void(0)">132
                                    <small>{{ __('Credit Data') }}</small>
                                </a>
                            </h4>
                            <small class="text-muted">16 waiting</small>
                        </div>
                    </div>
                </div>
            </div>


        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Last 10 days Statistics</h3>
                </div>
                <div id="chart-development-activity" style="height: 10rem"></div>
                <div class="table-responsive">
                    <table class="table card-table table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th colspan="2">User</th>
                                <th>Commit</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="w-1">
                                    <span class="avatar" style="background-image: url(./demo/faces/male/9.jpg)"></span>
                                </td>
                                <td>Ronald Bradley</td>
                                <td>Initial commit</td>
                                <td class="text-nowrap">May 6, 2018</td>
                                <td class="w-1">
                                    <a href="#" class="icon">
                                        <i class="fe fe-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="avatar">BM</span>
                                </td>
                                <td>Russell Gibson</td>
                                <td>Main structure</td>
                                <td class="text-nowrap">April 22, 2018</td>
                                <td>
                                    <a href="#" class="icon">
                                        <i class="fe fe-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="avatar" style="background-image: url(./demo/faces/female/1.jpg)"></span>
                                </td>
                                <td>Beverly Armstrong</td>
                                <td>Left sidebar adjusments</td>
                                <td class="text-nowrap">April 15, 2018</td>
                                <td>
                                    <a href="#" class="icon">
                                        <i class="fe fe-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="avatar" style="background-image: url(./demo/faces/male/4.jpg)"></span>
                                </td>
                                <td>Bobby Knight</td>
                                <td>Topbar dropdown style</td>
                                <td class="text-nowrap">April 8, 2018</td>
                                <td>
                                    <a href="#" class="icon">
                                        <i class="fe fe-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="avatar" style="background-image: url(./demo/faces/female/11.jpg)"></span>
                                </td>
                                <td>Sharon Wells</td>
                                <td>Fixes #625</td>
                                <td class="text-nowrap">April 9, 2018</td>
                                <td>
                                    <a href="#" class="icon">
                                        <i class="fe fe-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <script>
                require(['c3', 'jquery'], function (c3, $) {
                    $(document).ready(function () {
                        var chart = c3.generate({
                            bindto: '#chart-development-activity', // id of chart wrapper
                            data: {
                                columns: [
                                    // each columns data
                                    ['data1', 2000000, 0, 0, 0, 0, 100000, 15000, 0, 50000, 12000
                                    ],
                                    ['data2', 100000, 15000, 0, 50000, 12000, 20000, 0, 0, 0, 0
                                    ]
                                ],
                                type: 'area', // default type of chart
                                groups: [
                                    ['data1', 'data2', 'data3']
                                ],
                                colors: {
                                    'data1': tabler.colors["green"],
                                    'data2': tabler.colors["blue"]
                                },
                                names: {
                                    // name of each serie
                                    'data1': 'Income',
                                    'data2': 'Expenses'
                                }
                            },
                            axis: {
                                y: {
                                    padding: {
                                        bottom: 0,
                                    },
                                    show: false,
                                    tick: {
                                        outer: false
                                    }
                                },
                                x: {
                                    padding: {
                                        left: 0,
                                        right: 0
                                    },
                                    show: false
                                }
                            },
                            legend: {
                                position: 'inset',
                                padding: 0,
                                inset: {
                                    anchor: 'top-left',
                                    x: 20,
                                    y: 8,
                                    step: 10
                                }
                            },
                            tooltip: {
                                format: {
                                    title: function (x) {
                                        return '';
                                    }
                                }
                            },
                            padding: {
                                bottom: 0,
                                left: -1,
                                right: -1
                            },
                            point: {
                                show: false
                            }
                        });
                    });
                });
            </script>
        </div>
        <div class="col-md-6">
            <div class="alert alert-primary">Are you in trouble?
                <a href="./docs/index.html" class="alert-link">Read our documentation</a> with code samples.</div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="h5">Your Balance</div>
                            <div class="display-4 font-weight-bold mb-4">Rp. 1.987.100.123,-</div>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-green" style="width: 100%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Income Target</h3>
                        </div>
                        <div class="card-body">
                            <div id="chart-donut" style="height: 12rem;"></div>
                        </div>
                    </div>
                    <script>
                        require(['c3', 'jquery'], function (c3, $) {
                            $(document).ready(function () {
                                var chart = c3.generate({
                                    bindto: '#chart-donut', // id of chart wrapper
                                    data: {
                                        columns: [
                                            // each columns data
                                            ['data1', 63],
                                            ['data2', 37]
                                        ],
                                        type: 'donut', // default type of chart
                                        colors: {
                                            'data1': tabler.colors["green"],
                                            'data2': tabler.colors["green-light"]
                                        },
                                        names: {
                                            // name of each serie
                                            'data1': 'Maximum',
                                            'data2': 'Minimum'
                                        }
                                    },
                                    axis: {},
                                    legend: {
                                        show: false, //hide legend
                                    },
                                    padding: {
                                        bottom: 0,
                                        top: 0
                                    },
                                });
                            });
                        });
                    </script>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Expenses Target</h3>
                        </div>
                        <div class="card-body">
                            <div id="chart-pie" style="height: 12rem;"></div>
                        </div>
                    </div>
                    <script>
                        require(['c3', 'jquery'], function (c3, $) {
                            $(document).ready(function () {
                                var chart = c3.generate({
                                    bindto: '#chart-pie', // id of chart wrapper
                                    data: {
                                        columns: [
                                            // each columns data
                                            ['data1', 63],
                                            ['data2', 44],
                                            ['data3', 12],
                                            ['data4', 14]
                                        ],
                                        type: 'pie', // default type of chart
                                        colors: {
                                            'data1': tabler.colors["blue-darker"],
                                            'data2': tabler.colors["blue"],
                                            'data3': tabler.colors["blue-light"],
                                            'data4': tabler.colors["blue-lighter"]
                                        },
                                        names: {
                                            // name of each serie
                                            'data1': 'A',
                                            'data2': 'B',
                                            'data3': 'C',
                                            'data4': 'D'
                                        }
                                    },
                                    axis: {},
                                    legend: {
                                        show: false, //hide legend
                                    },
                                    padding: {
                                        bottom: 0,
                                        top: 0
                                    },
                                });
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row row-cards row-deck">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                        <thead>
                            <tr>
                                <th class="text-center w-1">
                                    <i class="icon-people"></i>
                                </th>
                                <th>Account Name</th>
                                <th>Usage</th>
                                <th class="text-center">Payment</th>
                                <th>Activity</th>
                                <th class="text-center">Satisfaction</th>
                                <th class="text-center">
                                    <i class="icon-settings"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">
                                    <div class="avatar d-block" style="background-image: url({{ asset('assets/images/azishapidin.jpg') }})">
                                        <span class="avatar-status bg-green"></span>
                                    </div>
                                </td>
                                <td>
                                    <div>Rekening Bank BNI</div>
                                    <div class="small text-muted">
                                        Registered: Feb 27, 2018
                                    </div>
                                </td>
                                <td>
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <strong>42%</strong>
                                        </div>
                                        <div class="float-right">
                                            <small class="text-muted">Jun 11, 2015 - Jul 10, 2015</small>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-yellow" role="progressbar" style="width: 42%" aria-valuenow="42" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <i class="payment payment-visa"></i>
                                </td>
                                <td>
                                    <div class="small text-muted">Last login</div>
                                    <div>4 minutes ago</div>
                                </td>
                                <td class="text-center">
                                    <div class="mx-auto chart-circle chart-circle-xs" data-value="0.42" data-thickness="3" data-color="blue">
                                        <div class="chart-circle-value">42%</div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="item-action dropdown">
                                        <a href="javascript:void(0)" data-toggle="dropdown" class="icon">
                                            <i class="fe fe-more-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="javascript:void(0)" class="dropdown-item">
                                                <i class="dropdown-icon fe fe-tag"></i> Action </a>
                                            <a href="javascript:void(0)" class="dropdown-item">
                                                <i class="dropdown-icon fe fe-edit-2"></i> Another action </a>
                                            <a href="javascript:void(0)" class="dropdown-item">
                                                <i class="dropdown-icon fe fe-message-square"></i> Something else here</a>
                                            <div class="dropdown-divider"></div>
                                            <a href="javascript:void(0)" class="dropdown-item">
                                                <i class="dropdown-icon fe fe-link"></i> Separated link</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection