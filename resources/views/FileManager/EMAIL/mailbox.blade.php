@extends('NEW.AUTH.layout')
@section('page_title')
    Mail Inbox
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Inbox</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Inbox</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <a href="{{ route('mail.compose') }}" class="btn btn-primary btn-block mb-3">Compose</a>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Folders</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item active">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-inbox"></i> Inbox
                                    <span class="badge bg-primary float-right">12</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-envelope"></i> Sent
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-file-alt"></i> Drafts
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-filter"></i> Junk
                                    <span class="badge bg-warning float-right">65</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-trash-alt"></i> Trash
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Labels</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle text-danger"></i>
                                    Important
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle text-warning"></i> Promotions
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle text-primary"></i>
                                    Social
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

            <div class="col-md-9">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Inbox</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" placeholder="Search Mail">
                                <div class="input-group-append">
                                    <div class="btn btn-primary">
                                        <i class="fas fa-search"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-tools -->
                    </div>

                    <div class="card-body p-0">
                        <div class="mailbox-controls">
                            <!-- Check all button -->
                            <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i
                                    class="far fa-square"></i>
                            </button>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm">
                                    <a href="#" title="delete selected"><i class="far fa-trash-alt"></i></a>
                                </button>
                                <button type="button" class="btn btn-default btn-sm">
                                    <a href="#" title="reply mail"><i class="fas fa-reply"></i></a>
                                </button>
                                <button type="button" class="btn btn-default btn-sm">
                                    <a href="#" title="forward mail"><i class="fas fa-share"></i></a>
                                </button>
                            </div>
                            <!-- /.btn-group -->
                            <button type="button" class="btn btn-default btn-sm">
                               <a href="{{ route('mail.inbox') }}" title="Refresh inbox"> <i class="fas fa-sync-alt"></i></a>
                            </button>
                            <div class="float-right">
                                1-50/200
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <button type="button" class="btn btn-default btn-sm">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </div>
                                <!-- /.btn-group -->
                            </div>
                            <!-- /.float-right -->
                        </div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="icheck-primary">
                                                <input type="checkbox" value="" id="check1">
                                                <label for="check1"></label>
                                            </div>
                                        </td>
                                        <td class="mailbox-star"><a href="#"><i
                                                    class="fas fa-star text-warning"></i></a></td>
                                        <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                                        <td class="mailbox-subject"><b>AdminLTE 3.0 Issue</b> - Trying to find a solution
                                            to this problem...
                                        </td>
                                        <td class="mailbox-attachment"></td>
                                        <td class="mailbox-date">5 mins ago</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="icheck-primary">
                                                <input type="checkbox" value="" id="check2">
                                                <label for="check2"></label>
                                            </div>
                                        </td>
                                        <td class="mailbox-star"><a href="#"><i
                                                    class="fas fa-star-o text-warning"></i></a></td>
                                        <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                                        <td class="mailbox-subject"><b>AdminLTE 3.0 Issue</b> - Trying to find a solution
                                            to this problem...
                                        </td>
                                        <td class="mailbox-attachment"><i class="fas fa-paperclip"></i></td>
                                        <td class="mailbox-date">28 mins ago</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="icheck-primary">
                                                <input type="checkbox" value="" id="check3">
                                                <label for="check3"></label>
                                            </div>
                                        </td>
                                        <td class="mailbox-star"><a href="#"><i
                                                    class="fas fa-star-o text-warning"></i></a></td>
                                        <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                                        <td class="mailbox-subject"><b>AdminLTE 3.0 Issue</b> - Trying to find a solution
                                            to this problem...
                                        </td>
                                        <td class="mailbox-attachment"><i class="fas fa-paperclip"></i></td>
                                        <td class="mailbox-date">11 hours ago</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="icheck-primary">
                                                <input type="checkbox" value="" id="check4">
                                                <label for="check4"></label>
                                            </div>
                                        </td>
                                        <td class="mailbox-star"><a href="#"><i
                                                    class="fas fa-star text-warning"></i></a></td>
                                        <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                                        <td class="mailbox-subject"><b>AdminLTE 3.0 Issue</b> - Trying to find a solution
                                            to this problem...
                                        </td>
                                        <td class="mailbox-attachment"></td>
                                        <td class="mailbox-date">15 hours ago</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="icheck-primary">
                                                <input type="checkbox" value="" id="check5">
                                                <label for="check5"></label>
                                            </div>
                                        </td>
                                        <td class="mailbox-star"><a href="#"><i
                                                    class="fas fa-star text-warning"></i></a></td>
                                        <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                                        <td class="mailbox-subject"><b>AdminLTE 3.0 Issue</b> - Trying to find a solution
                                            to this problem...
                                        </td>
                                        <td class="mailbox-attachment"><i class="fas fa-paperclip"></i></td>
                                        <td class="mailbox-date">Yesterday</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="icheck-primary">
                                                <input type="checkbox" value="" id="check6">
                                                <label for="check6"></label>
                                            </div>
                                        </td>
                                        <td class="mailbox-star"><a href="#"><i
                                                    class="fas fa-star-o text-warning"></i></a></td>
                                        <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                                        <td class="mailbox-subject"><b>AdminLTE 3.0 Issue</b> - Trying to find a solution
                                            to this problem...
                                        </td>
                                        <td class="mailbox-attachment"><i class="fas fa-paperclip"></i></td>
                                        <td class="mailbox-date">2 days ago</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="icheck-primary">
                                                <input type="checkbox" value="" id="check7">
                                                <label for="check7"></label>
                                            </div>
                                        </td>
                                        <td class="mailbox-star"><a href="#"><i
                                                    class="fas fa-star-o text-warning"></i></a></td>
                                        <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                                        <td class="mailbox-subject"><b>AdminLTE 3.0 Issue</b> - Trying to find a solution
                                            to this problem...
                                        </td>
                                        <td class="mailbox-attachment"><i class="fas fa-paperclip"></i></td>
                                        <td class="mailbox-date">2 days ago</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="icheck-primary">
                                                <input type="checkbox" value="" id="check8">
                                                <label for="check8"></label>
                                            </div>
                                        </td>
                                        <td class="mailbox-star"><a href="#"><i
                                                    class="fas fa-star text-warning"></i></a></td>
                                        <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                                        <td class="mailbox-subject"><b>AdminLTE 3.0 Issue</b> - Trying to find a solution
                                            to this problem...
                                        </td>
                                        <td class="mailbox-attachment"></td>
                                        <td class="mailbox-date">2 days ago</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="icheck-primary">
                                                <input type="checkbox" value="" id="check9">
                                                <label for="check9"></label>
                                            </div>
                                        </td>
                                        <td class="mailbox-star"><a href="#"><i
                                                    class="fas fa-star text-warning"></i></a></td>
                                        <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                                        <td class="mailbox-subject"><b>AdminLTE 3.0 Issue</b> - Trying to find a solution
                                            to this problem...
                                        </td>
                                        <td class="mailbox-attachment"></td>
                                        <td class="mailbox-date">2 days ago</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="icheck-primary">
                                                <input type="checkbox" value="" id="check10">
                                                <label for="check10"></label>
                                            </div>
                                        </td>
                                        <td class="mailbox-star"><a href="#"><i
                                                    class="fas fa-star-o text-warning"></i></a></td>
                                        <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                                        <td class="mailbox-subject"><b>AdminLTE 3.0 Issue</b> - Trying to find a solution
                                            to this problem...
                                        </td>
                                        <td class="mailbox-attachment"></td>
                                        <td class="mailbox-date">2 days ago</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="icheck-primary">
                                                <input type="checkbox" value="" id="check11">
                                                <label for="check11"></label>
                                            </div>
                                        </td>
                                        <td class="mailbox-star"><a href="#"><i
                                                    class="fas fa-star-o text-warning"></i></a></td>
                                        <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                                        <td class="mailbox-subject"><b>AdminLTE 3.0 Issue</b> - Trying to find a solution
                                            to this problem...
                                        </td>
                                        <td class="mailbox-attachment"><i class="fas fa-paperclip"></i></td>
                                        <td class="mailbox-date">4 days ago</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="icheck-primary">
                                                <input type="checkbox" value="" id="check12">
                                                <label for="check12"></label>
                                            </div>
                                        </td>
                                        <td class="mailbox-star"><a href="#"><i
                                                    class="fas fa-star text-warning"></i></a></td>
                                        <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                                        <td class="mailbox-subject"><b>AdminLTE 3.0 Issue</b> - Trying to find a solution
                                            to this problem...
                                        </td>
                                        <td class="mailbox-attachment"></td>
                                        <td class="mailbox-date">12 days ago</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="icheck-primary">
                                                <input type="checkbox" value="" id="check13">
                                                <label for="check13"></label>
                                            </div>
                                        </td>
                                        <td class="mailbox-star"><a href="#"><i
                                                    class="fas fa-star-o text-warning"></i></a></td>
                                        <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                                        <td class="mailbox-subject"><b>AdminLTE 3.0 Issue</b> - Trying to find a solution
                                            to this problem...
                                        </td>
                                        <td class="mailbox-attachment"><i class="fas fa-paperclip"></i></td>
                                        <td class="mailbox-date">12 days ago</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="icheck-primary">
                                                <input type="checkbox" value="" id="check14">
                                                <label for="check14"></label>
                                            </div>
                                        </td>
                                        <td class="mailbox-star"><a href="#"><i
                                                    class="fas fa-star text-warning"></i></a></td>
                                        <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                                        <td class="mailbox-subject"><b>AdminLTE 3.0 Issue</b> - Trying to find a solution
                                            to this problem...
                                        </td>
                                        <td class="mailbox-attachment"><i class="fas fa-paperclip"></i></td>
                                        <td class="mailbox-date">14 days ago</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="icheck-primary">
                                                <input type="checkbox" value="" id="check15">
                                                <label for="check15"></label>
                                            </div>
                                        </td>
                                        <td class="mailbox-star"><a href="#"><i
                                                    class="fas fa-star text-warning"></i></a></td>
                                        <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                                        <td class="mailbox-subject"><b>AdminLTE 3.0 Issue</b> - Trying to find a solution
                                            to this problem...
                                        </td>
                                        <td class="mailbox-attachment"><i class="fas fa-paperclip"></i></td>
                                        <td class="mailbox-date">15 days ago</td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- /.table -->
                        </div>
                        <!-- /.mail-box-messages -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer p-0">
                        <div class="mailbox-controls">
                            <!-- Check all button -->
                            <button type="button" class="btn btn-default btn-sm checkbox-toggle">
                                <i class="far fa-square"></i>
                            </button>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                                <button type="button" class="btn btn-default btn-sm">
                                    <i class="fas fa-reply"></i>
                                </button>
                                <button type="button" class="btn btn-default btn-sm">
                                    <i class="fas fa-share"></i>
                                </button>
                            </div>
                            <!-- /.btn-group -->
                            <button type="button" class="btn btn-default btn-sm">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                            <div class="float-right">
                                1-50/200
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <button type="button" class="btn btn-default btn-sm">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </div>
                                <!-- /.btn-group -->
                            </div>
                            <!-- /.float-right -->
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>

        </div>
        <!-- /.row -->
    </section>
@endsection
@section('scripts')
    <script>
        $(function() {
            //Enable check and uncheck all functionality
            $('.checkbox-toggle').click(function() {
                var clicks = $(this).data('clicks')
                if (clicks) {
                    //Uncheck all checkboxes
                    $('.mailbox-messages input[type=\'checkbox\']').prop('checked', false)
                    $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass(
                        'fa-square')
                } else {
                    //Check all checkboxes
                    $('.mailbox-messages input[type=\'checkbox\']').prop('checked', true)
                    $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass(
                        'fa-check-square')
                }
                $(this).data('clicks', !clicks)
            })

            //Handle starring for font awesome
            $('.mailbox-star').click(function(e) {
                e.preventDefault()
                //detect type
                var $this = $(this).find('a > i')
                var fa = $this.hasClass('fa')

                //Switch states
                if (fa) {
                    $this.toggleClass('fa-star')
                    $this.toggleClass('fa-star-o')
                }
            })
        })
    </script>
@endsection
