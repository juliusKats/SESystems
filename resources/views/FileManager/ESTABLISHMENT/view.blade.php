 @extends('NEW.AUTH.layout')
 @section('page_title')
     Vote Details
 @endsection
 @section('content')
     <div class="main-content">
         <section class="section">
             <?php
             $uploaddate = \Carbon\Carbon::parse($file->UploadDate)->format('M d, Y');
             $psdate = \Carbon\Carbon::parse($file->PSDate)->format('d/m/YY');
             $createdate = \Carbon\Carbon::parse($file->CrDate)->format('d/m/Y');
             $update = \Carbon\Carbon::parse($file->UpDate)->format('M d, Y');
             $admindate = \Carbon\Carbon::parse($file->ADMINApproval)->format('M d, Y');

             $Yr = explode('_', $file)[3];
             $Month = explode('_', $file)[2];
             $PDFsize = Number::fileSize(File::size('storage/Votes/' . $Yr . '/' . $Month . '/PSPDF/' . $file->PDF));
             $finalPDF = explode('_', $file->PDF)[5];

             $EXCELsize = Number::fileSize(File::size('storage/Votes/' . $Yr . '/' . $Month . '/Excel/' . $file->EXCEL));
             $finalEXCEL = explode('_', $file->EXCEL)[5];

             ?>
             <div class="section-header">
                 <h1>Viewing Details of {{ $file->VCode }} - {{ $file->VName }}</h1>
             </div>
             <div class="section-body">
                 <div class="card-header">
                     <span class="float float-right" style="display: flex">
                         {{-- only by owner --}}
                         <button class="btn btn-sm btn-primary"> <i class="fa fa-edit"></i> Edit </button>
                         {{--  only admin and owner --}}
                         <form method="post" action="{{ route('soft.delete', $file->id) }}">
                             @csrf
                             @method('DELETE')

                             <button type="submit" class="btn btn-danger btn-sm ml-4 mt-1 btn-softdelete">
                                 <i class="fa fa-trash"></i> Trash
                             </button>
                         </form>

                         <form action="{{ route('delete.vote', $file->id) }}" method="post">
                             @csrf
                             @method('DELETE')
                             <button class="btn btn-danger btn-sm ml-4 mt-1 btn-delete">
                                 <i class="fa fa-solid fa-trash"></i>
                                 Delete
                             </button>
                         </form>
                         {{-- only admin --}}
                         <form method="post" action="{{ route('file.approve', $file->id) }}">
                             @csrf
                             @method('PUT')
                             <button type="submit" class="btn btn-sm ml-4 btn-outline-success btn-approve mt-1"
                                 data-dismiss="modal">
                                 <i class="fa fa-check-circle"></i> Approve</button>
                         </form>

                         @if ($file->status == 'Active' || $file->status == 'Pending')
                             <button class="ml-4 mt-1 btn btn-warning btn-sm"><i class="fa fa-ban"></i> Reject</button>
                         @endif
                     </span>
                 </div>
                 <div class="card-body">
                     @if (session('success'))
                         <div class="card card-success">
                             <div class="card-header">
                                 <h3 class="card-title">{{ session('success') }}</h3>
                                 <div class="card-tools">
                                     <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                         <i class="fas fa-minus"></i>
                                     </button>
                                     <button type="button" class="btn btn-tool" data-card-widget="remove">
                                         <i class="fas fa-times"></i>
                                     </button>
                                 </div>
                             </div>
                         </div>
                     @endif
                     @if (session('error'))
                         <div class="card card-danger">
                             <div class="card-header">
                                 <h3 class="card-title">{{ session('error') }}</h3>
                                 <div class="card-tools">
                                     <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                         <i class="fas fa-minus"></i>
                                     </button>
                                     <button type="button" class="btn btn-tool" data-card-widget="remove">
                                         <i class="fas fa-times"></i>
                                     </button>
                                 </div>
                             </div>
                         </div>
                     @endif
                     {{-- <div class="row"> --}}

                     <div class="row">
                         <div class="col-md-6">
                             <div class="card">
                                 <div class="card-header mb-2">
                                     <h4 class= "text text-center">User Section</h4>
                                 </div>
                                 <div class="card-body">

                                     <form>
                                         <div class="form-group mb-1 row">
                                             <label class="col-md-3">Ticket</label>
                                             <div class="col-md-9">
                                                 <input id="ticket"
                                                     class="form-control  @error('ticket') is-invalid @enderror" required
                                                     name="ticket" minlength="13" maxlength="13"
                                                     value="{{ $file->ticket }}">
                                                 @error('ticket')
                                                     <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong>
                                                     </span>
                                                 @enderror
                                             </div>
                                         </div>
                                         <div class="form-group mb-1 row">
                                             <label class="col-md-3">Vote Code</label>
                                             <div class="col-md-9">
                                                 <select id="votecode"
                                                     class="select2 form-control  @error('votecode') is-invalid @enderror"
                                                     required name="votecode">
                                                     <option>Select Vote</option>
                                                     @foreach ($votes as $key => $item)
                                                         <option value="{{ $item->id }}"
                                                             @if ($file->VCode == $item->votecode) selected @endif>
                                                             {{ $item->votecode }} - {{ $item->votename }}
                                                         </option>
                                                     @endforeach
                                                 </select>
                                                 @error('votecode')
                                                     <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong>
                                                     </span>
                                                 @enderror
                                             </div>
                                         </div>
                                         <div class="form-group row mb-1">
                                             <label class="col-sm-3">Vote Name</label>
                                             <div class="col-md-9">
                                                 <input id="votename" type="text"
                                                     class="form-control @error('votename') is-invalid @enderror" required
                                                     name="votename" value="{{ $file->VName }}" readonly>
                                                 @error('votename')
                                                     <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong>
                                                     </span>
                                                 @enderror
                                             </div>
                                         </div>
                                         <div class="form-group row mb-1">
                                             <label class="col-md-3">Excel File </label>
                                             <div class="col-md-9">
                                                 <input required name="excel" type="file"
                                                     class="form-control @error('excel') is-invalid @enderror"
                                                     accept=".xlsx,.xls" value="{{ $file->EXCEL }}">
                                                 @error('excel')
                                                     <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong>
                                                     </span>
                                                 @enderror
                                             </div>
                                         </div>
                                         <div class="form-group row mb-1">
                                             <label class="col-md-3">PDF File </label>
                                             <div class="col-md-9">
                                                 <input required name="pdf" type="file"
                                                     class="form-control @error('pdf')is-invalid @enderror" accept=".pdf"
                                                     value="{{ $file->PDF }}">
                                                 @error('pdf')
                                                     <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong>
                                                     </span>
                                                 @enderror
                                             </div>
                                         </div>
                                         <div class="form-group row mb-1">
                                             <label class="col-md-3">PS Approved On </label>
                                             <div class="col-md-9">
                                                 <input required name="approvaldate" type="date"
                                                     class="form-control @error('approvaldate')is-invalid @enderror"
                                                     value="{{ $file->PSDate }}">
                                                 @error('approvaldate')
                                                     <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong>
                                                     </span>
                                                 @enderror
                                             </div>
                                         </div>
                                         <div class="form-group row mb-1">
                                             <label class="col-md-3">Document Version </label>
                                             <div class="col-md-9">
                                                 <select name="version" class="form-control select2" required>
                                                     <option>Select Version</option>
                                                     @foreach ($versions as $item)
                                                         <option value="{{ $item->id }}"
                                                             @if ($file->versionId == $item->id) selected @endif>
                                                             {{ $item->versionname }}
                                                         </option>
                                                     @endforeach
                                                 </select>

                                                 @error('version')
                                                     <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong>
                                                     </span>
                                                 @enderror
                                             </div>
                                         </div>
                                         <div class="form-group mb-1">
                                             <label>Comment </label>
                                             <textarea name="comment" id="summernote3" disabled
                                                 class="summernote3 readonly @error('comment')is-invalid @enderror">{{ $file->VComment }}</textarea>
                                             @error('comment')
                                                 <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                 </span>
                                             @enderror
                                         </div>
                                         <div class="form-group row mb-1">
                                             <div class="col-md-6">
                                                 <div class="form-group mb-1">
                                                     <label>Uploaded By </label>
                                                     <input type="text" name="uploadedby"
                                                         class="form-control @error('uploadedby')is-invalid @enderror"
                                                         value="{{ $file->sname }} {{ $file->fname }} {{ $file->oname }}">
                                                     @error('uploadedby')
                                                         <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong>
                                                         </span>
                                                     @enderror
                                                 </div>
                                             </div>
                                             <div class="col-md-6">
                                                 <div class="form-group mb-1">
                                                     <label>Uploaded On </label>
                                                     <input type="date" name="uploadedOn"
                                                         class="form-control @error('uploadedon')is-invalid @enderror"
                                                         value="{{ $file->UploadDate }}">
                                                     @error('uploadedOn')
                                                         <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong>
                                                         </span>
                                                     @enderror
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="form-group row mb-1">
                                             <label class="col-md-3">Status</label>
                                             <div class="col-md-9">
                                                 <select id="status"
                                                     class="select2 form-control  @error('status') is-invalid @enderror"
                                                     required name="status">
                                                     <option>Select status</option>
                                                     @foreach ($status as $key => $item)
                                                         <option value="{{ $item->id }}"
                                                             @if ($file->State == $item->id) selected @endif>
                                                             {{ $item->statusName }}
                                                         </option>
                                                     @endforeach
                                                 </select>
                                                 @error('votecode')
                                                     <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong>
                                                     </span>
                                                 @enderror
                                             </div>
                                         </div>

                                         <div id="userAction" class="form-group mt-2">
                                             <button class="btn btn-outline-primary ">Cancel</button>
                                             <button class="btn  btn-outline-success float float-right">Update</button>
                                         </div>
                                     </form>

                                 </div>
                             </div>


                             {{-- User Activivties
                                     <hr>

                                     <div class="form-group row">
                                         <label class="col-sm-3">Vote Code</label>
                                         <div class="col-mb-9">
                                             <select id="votecode"
                                                 class="form-control select2 @error('votecode') is-invalid @enderror"
                                                 required name="votecode">
                                                 <option>Select Vote</option>
                                                 @foreach ($votes as $key => $item)
                                                     <option value="{{ $item->id }}"
                                                         @if (old('votecode') == $item->id) selected @endif>
                                                         {{ $item->votecode }} - {{ $item->votename }}
                                                     </option>
                                                 @endforeach
                                             </select>
                                             @error('votecode')
                                                 <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                 </span>
                                             @enderror
                                         </div>
                                     </div> --}}

                         </div>
                         <div class="col-md-6">
                             <div class="card">
                                 <div class="card-header mb-2">
                                     <h4 class= "text text-center">Admin Section</h4>
                                 </div>
                                 <div class="card-body">
                                     <form>
                                         @if ($file->State == 3)
                                             {{-- approve --}}
                                             <div class="form-group row mb-1">
                                                 <div class="col-md-6">
                                                     <div class="form-group mb-1">
                                                         <label>Approved By </label>
                                                         <input type="text" name="uploadedby"
                                                             class="form-control @error('uploadedby')is-invalid @enderror"
                                                             value="{{ $file->sname }} {{ $file->fname }} {{ $file->oname }}">
                                                         @error('uploadedby')
                                                             <span class="invalid-feedback" role="alert">
                                                                 <strong>{{ $message }}</strong>
                                                             </span>
                                                         @enderror
                                                     </div>
                                                 </div>
                                                 <div class="col-md-6">
                                                     <div class="form-group mb-1">
                                                         <label>Approved On </label>
                                                         <input type="date" name="uploadedOn"
                                                             class="form-control @error('uploadedon')is-invalid @enderror"
                                                             value="{{ $file->UploadDate }}">
                                                         @error('uploadedOn')
                                                             <span class="invalid-feedback" role="alert">
                                                                 <strong>{{ $message }}</strong>
                                                             </span>
                                                         @enderror
                                                     </div>
                                                 </div>
                                             </div>
                                         @elseif ($file->State == 5)
                                             {{-- Deleted --}}
                                             <div class="form-group row mb-1">
                                                 <div class="col-md-6">
                                                     <div class="form-group mb-1">
                                                         <label>Deleted By </label>
                                                         <input type="text" name="uploadedby"
                                                             class="form-control @error('uploadedby')is-invalid @enderror"
                                                             value="{{ $file->sname }} {{ $file->fname }} {{ $file->oname }}">
                                                         @error('uploadedby')
                                                             <span class="invalid-feedback" role="alert">
                                                                 <strong>{{ $message }}</strong>
                                                             </span>
                                                         @enderror
                                                     </div>
                                                 </div>
                                                 <div class="col-md-6">
                                                     <div class="form-group mb-1">
                                                         <label>Deleted On </label>
                                                         <input type="date" name="uploadedOn"
                                                             class="form-control @error('uploadedon')is-invalid @enderror"
                                                             value="{{ $file->UploadDate }}">
                                                         @error('uploadedOn')
                                                             <span class="invalid-feedback" role="alert">
                                                                 <strong>{{ $message }}</strong>
                                                             </span>
                                                         @enderror
                                                     </div>
                                                 </div>
                                             </div>
                                         @elseif ($file->State == 6)
                                             {{-- Restored --}}
                                             <div class="form-group row mb-1">
                                                 <div class="col-md-6">
                                                     <div class="form-group mb-1">
                                                         <label>Restored By </label>
                                                         <input type="text" name="uploadedby"
                                                             class="form-control @error('uploadedby')is-invalid @enderror"
                                                             value="{{ $file->sname }} {{ $file->fname }} {{ $file->oname }}">
                                                         @error('uploadedby')
                                                             <span class="invalid-feedback" role="alert">
                                                                 <strong>{{ $message }}</strong>
                                                             </span>
                                                         @enderror
                                                     </div>
                                                 </div>
                                                 <div class="col-md-6">
                                                     <div class="form-group mb-1">
                                                         <label>Restored On </label>
                                                         <input type="date" name="uploadedOn"
                                                             class="form-control @error('uploadedon')is-invalid @enderror"
                                                             value="{{ $file->UploadDate }}">
                                                         @error('uploadedOn')
                                                             <span class="invalid-feedback" role="alert">
                                                                 <strong>{{ $message }}</strong>
                                                             </span>
                                                         @enderror
                                                     </div>
                                                 </div>
                                             </div>
                                         @elseif ($file->State == 4)
                                             {{-- Rejected --}}
                                             <div class="form-group row mb-1">
                                                 <div class="col-md-6">
                                                     <div class="form-group mb-1">
                                                         <label>Rejected By </label>
                                                         <input type="text" name="uploadedby"
                                                             class="form-control @error('uploadedby')is-invalid @enderror"
                                                             value="{{ $file->sname }} {{ $file->fname }} {{ $file->oname }}">
                                                         @error('uploadedby')
                                                             <span class="invalid-feedback" role="alert">
                                                                 <strong>{{ $message }}</strong>
                                                             </span>
                                                         @enderror
                                                     </div>
                                                 </div>
                                                 <div class="col-md-6">
                                                     <div class="form-group mb-1">
                                                         <label>Rejected On </label>
                                                         <input type="date" name="uploadedOn"
                                                             class="form-control @error('uploadedon')is-invalid @enderror"
                                                             value="{{ $file->UploadDate }}">
                                                         @error('uploadedOn')
                                                             <span class="invalid-feedback" role="alert">
                                                                 <strong>{{ $message }}</strong>
                                                             </span>
                                                         @enderror
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="form-group">
                                                 <label>Reason</label>
                                                 <textarea id="summernote4" class="form-control summernote-simple">
                                                {{ $file->Reason }}
                                            </textarea>
                                             </div>
                                         @endif
                                         <div id="adminAction">
                                            <div class="form-group">
                                                 <label>Reason</label>
                                                 <textarea id="summernote" class="form-control summernote-simple">
                                                {{ $file->Reason }}
                                            </textarea>
                                             </div>
                                             <div class="form-group mt-1">
                                                 <button class="btn btn-outline-primary ">Cancel</button>
                                                 <button class="btn  btn-outline-success float float-right">Reject</button>
                                             </div>
                                         </div>

                                     </form>





                                     {{-- reason --}}

                                 </div>
                             </div>
                             {{-- Admin Activities<hr>
                                    <div class="form-group row">
                                         <label class="col-sm-3">Vote Code</label>
                                         <div class="col-mb-9">
                                             <select id="votecode"
                                                 class="form-control select2 @error('votecode') is-invalid @enderror"
                                                 required name="votecode">
                                                 <option>Select Vote</option>
                                                 @foreach ($votes as $key => $item)
                                                     <option value="{{ $item->id }}"
                                                         @if (old('votecode') == $item->id) selected @endif>
                                                         {{ $item->votecode }} - {{ $item->votename }}
                                                     </option>
                                                 @endforeach
                                             </select>
                                             @error('votecode')
                                                 <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                 </span>
                                             @enderror
                                         </div>
                                     </div>
                                  --}}
                         </div>
                     </div>

                     {{-- </div> --}}


                     {{-- <div class="row">
                         <div class="col-md-4">
                             <div class="form-group">
                                 <label>Vote</label>
                                 <input type="text" value="{{ $file->VCode }} - {{ $file->VName }}" readonly
                                     class="form-control">
                             </div>
                         </div>
                         <div class="col-md-4">
                             <label>UPLOADED BY</label>
                             <input type="text" value="{{ $file->Name }}" readonly class="form-control">
                         </div>
                         <div class="col-md-4">
                             <label>UPLOADED ON</label>
                             <input type="text" value="{{ $uploaddate }}" readonly class="form-control">
                         </div>

                     </div>
                     <div class="row">
                         <div class="col-md-4">
                             <div class="form-group">
                                 <div><label> Uploaded Files</label></div>
                                 <div>
                                     <a href="{{ route('preview.ps.file', $file->id) }}" title="Preview {{ $file->PDF }}"
                                         style="font-size: 20px;" target="_blank">
                                         <i style="color: red; font-size: 30px;" class="fas fa-file-excel"></i>
                                         {{ $finalPDF }}
                                         &nbsp;&nbsp; -{{ $PDFsize }}
                                     </a>
                                 </div>

                                 <div>
                                     <a href="{{ route('preview.excel.file', $file->id) }}"
                                         title="Preview {{ $finalEXCEL }}" style="font-size: 20px;" target="_blank">
                                         <i style="color: green; font-size: 30px;" class="fas fa-file-excel"></i>
                                         {{ $finalEXCEL }}
                                         &nbsp;&nbsp; -{{ $EXCELsize }}
                                     </a>
                                 </div>

                             </div>
                             <div class="form-group">
                                 <label>PS Vote Approval Date</label>
                                 <input type="text" value="{{ $psdate }}" readonly class="form-control">
                             </div>
                         </div>
                         <div class="col-md-4">

                         </div>
                         <div class="col-md-4">
                             <div class="row">
                                 <div class="col-md-4">
                                     <div class="form-group">
                                         <div><label>Status</label></div>
                                         <div>
                                             @if ($file->status == 'Active')
                                                 <buton class="btn btn-success">Activated </buton>
                                             @else
                                                 @if ($createdate == $update)
                                                     <buton class="btn btn-warning">Pending </buton>
                                                 @else
                                                     <buton class="btn btn-success">Deactivated </buton>
                                                 @endif
                                             @endif
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-md-8">
                                     <div class="form-group">
                                         <label>
                                             @if ($file->status == 'Active')
                                                 Activated On
                                             @elseif($file->status == 'Reject')
                                                 Rejected On
                                             @else
                                                 Deactivated On
                                             @endif
                                         </label>
                                         <input type="text" value="{{ $update }}" readonly class="form-control">
                                     </div>
                                 </div>
                             </div>

                             <div class="form-group">
                                 <label>
                                     @if ($file->status == 'Active')
                                         Activated By
                                     @elseif($file->status == 'Reject')
                                         Rejected By
                                     @else
                                         Deactivated By
                                     @endif
                                 </label>
                                 <input type="text" value="{{ $file->UpprovedBy }}" readonly class="form-control">
                             </div>

                         </div>
                     </div>
                     <div class="row">
                         <div class="col-md-12">
                             <form method="post" action="{{ route('file.reject.save', $file->id) }}">
                                 @csrf
                                 @method('PUT')
                                 <div class="form-group">
                                     <label>Rejection Reason</label>
                                     <textarea name="reason" id="summernote" class="summernote @error('reason')is-invalid @enderror">{{ old('comment') }}</textarea>
                                     @error('reason')
                                         <span class="invalid-feedback" role="alert">
                                             <strong>{{ $message }}</strong>
                                         </span>
                                     @enderror
                                 </div>
                                 <div class="form-group">
                                     <input type="submit" class="btn btn-danger" value="Reject">
                                 </div>
                             </form>
                         </div>
                     </div> --}}
                 </div>
             </div>
         </section>
     </div>
 @endsection
 @section('scripts')
     <script>
         var votename = document.getElementById('votename')
         $('#votecode').on('change', function() {
             var VoteId = $(this).val()
             $.ajax({
                 url: "{{ route('fetch-vote') }}",
                 type: 'GET',
                 data: {
                     'vote_id': VoteId,
                     _token: '{{ csrf_token() }}',
                 },
                 dataType: 'json',
                 success: function(result) {
                     console.log(result)
                     console.log(result.vote.length)
                     // if (result.vote.length != 0) {
                     $.each(result.vote, function(key, value) {
                         votename.value = value.votename
                     })
                     // }
                 },
                 error: function(error) {
                     alert(error)
                 }
             })
         })
     </script>
 @endsection
