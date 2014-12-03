@extends('admin.master')

@section('content')

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Admin Homepage</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-users fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ count($data['new_users']) }}</div>
                            <div>New Users!</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-music fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ count($data['new_events']) }}</div>
                            <div>New Events!</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-microphone fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ count($data['new_artists']) }}</div>
                            <div>New Artists!</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="row" id="users">
        <div class="col-lg-8">
            <!-- /.panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-list fa-fw"></i> Browse Users
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="col-lg-12">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Last Name</th>
                                    <th>Email Address</th>
                                    <th>Birthday</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Zip Code</th>
                                    <th>Phone number</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['users'] as $user)
                                    <tr>
                                        <td> {{ $user->f_name }} </td>
                                        <td> {{ $user->l_name }} </td>
                                        <td> {{ $user->email }} </td>
                                        <td> {{ $user->b_day}}</td>
                                        <td> {{ $user->address }} </td>
                                        <td> {{ $user->city}} </td>
                                        <td> {{ $user->state}} </td>
                                        <td> {{ $user->zip}} </td>
                                        <td> {{ $user->phone}} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <?php Paginator::setPageName('user_page'); ?>
                        {{ 
                            $data['users']->appends('show_page', Input::get('show_page', 1))
                            ->appends('artist_page', Input::get('artist_page', 1))->appends('last_requested','user')->links()
                        }}
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
    <!-- /.row -->
    <div class="row" id="events">
        <div class="col-lg-8">
            <!-- /.panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-list fa-fw"></i> Browse Events
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="col-lg-12">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Artist</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['shows'] as $show)
                                    <tr>
                                        <td> {{ $show->when }} </td>
                                        <td> @if($show->artist)
                                            {{ $show->artist->name }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <?php Paginator::setPageName('show_page'); ?>
                        {{ 
                            $data['shows']->appends('user_page', Input::get('user_page', 1))
                            ->appends('artist_page', Input::get('artist_page', 1))->appends('last_requested','show')->links()
                        }}
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- .row -->
    </div>
    <div class="row" id="artists">
        <div class="col-lg-8">
            <!-- /.panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-list fa-fw"></i> Browse Artists
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="col-lg-12">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Artist</th>
                                    <th>Genre</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['artists'] as $artist)
                                    <tr>
                                        <td> {{ $artist->name }} </td>
                                        <td> {{ $artist->genre->name }} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <?php Paginator::setPageName('artist_page'); ?>
                        {{ 
                            $data['artists']->appends('user_page', Input::get('user_page', 1))->
                            appends('show_page', Input::get('show_page', 1))->appends('last_requested','artist')->links()
                        }}
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- .row -->
    </div>
</div>
<script>
    function getUrlParameter(sParam)
    {
        var sPageURL = window.location.search.substring(1);
        var sURLVariables = sPageURL.split('&');
        for (var i = 0; i < sURLVariables.length; i++) 
        {
            var sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] == sParam) 
            {
                return sParameterName[1];
            }
        }
    } 

        var last_requested = getUrlParameter('last_requested');
        if (last_requested == 'artist'){
            window.location.hash = '#artists';
        } 
        else if(last_requested == 'user'){
            window.location.hash = '#users';
        }
        else if (last_requested == 'show'){
            window.location.hash = '#events';

        }
</script>
<!-- /page-wrapper -->
@stop
