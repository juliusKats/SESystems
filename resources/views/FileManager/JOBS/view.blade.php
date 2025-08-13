 @extends('NEW.AUTH.layout')
 @section('page_title')
     Job Description
 @endsection
 @section('content')
     <div class="main-content">
         <section class="section">
             <?php
             $uploaddate = \Carbon\Carbon::parse($file->UpOn)->format('M d, Y');
             $psdate = \Carbon\Carbon::parse($file->PSDate)->format('d/m/YY');
             $update = \Carbon\Carbon::parse($file->UpDate)->format('M d, Y');
             $admindate = \Carbon\Carbon::parse($file->ADMINApproval)->format('M d, Y');

             $Yr = explode('_', $file)[3];
             $Month = explode('_', $file)[2];
             $PDFsize = Number::fileSize(File::size('storage/Jobs/' . $Yr . '/' . $Month . '/PSPDF/' . $file->PDF));
             $finalPDF = explode('_', $file->PDF)[5];

             $EXCELsize = Number::fileSize(File::size('storage/Jobs/' . $Yr . '/' . $Month . '/JDDOC/' . $file->EXCEL));
             $finalEXCEL = explode('_', $file->EXCEL)[5];

             ?>
             <?php
             $carder = explode(',', $file->carderName);
             ?>


             <div class="section-header">
                 <h1>Viewing Job Description of {{ $file->cardername }} - {{ $file->VName }}</h1>
             </div>
             <div class="section-body">
                 <div class="card-header">
                     <a href="{{ route('job.file.list') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to
                         List</a>

                     @auth
                         <span class="float float-right" style="display: flex">

                             @if (Auth::user()->id == $file->UploadedBy)
                                 {{-- only by owner --}}
                                 <button id="headerEdit" class="btn btn-sm btn-primary"> <i class="fa fa-edit"></i> Edit
                                 </button>
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
                             @endif
                             @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin' || Auth::user()->role == 'hod')
                                 {{-- only admin --}}
                                 <form method="post" action="{{ route('file.approve', $file->id) }}">
                                     @csrf
                                     @method('PUT')
                                     <button type="submit" class="btn btn-sm ml-4 btn-outline-success btn-approve mt-1"
                                         data-dismiss="modal">
                                         <i class="fa fa-check-circle"></i> Approve</button>
                                 </form>

                                 {{-- @if ($file->status == 'Active' || $file->status == 'Pending') --}}
                                 <button id="headerReject" class="ml-4 mt-1 btn btn-warning btn-sm"><i class="fa fa-ban"></i>
                                     Reject</button>
                                 {{-- @endif --}}
                             @endif
                         </span>
                     @endauth
                 </div>
                 <div class="card-body">
                     @if ($errors->any())
                         <div>
                             <div class="font-medium text-red-600">{{ __('Whoops! Something went wrong.') }}</div>

                             <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                 @foreach ($errors->all() as $error)
                                     <li>{{ $error }}</li>
                                 @endforeach
                             </ul>
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

                                     <form method="post" action="{{ route('job.file.update', $file->id) }}"
                                         enctype="multipart/form-data">
                                         @method('PUT')
                                         @csrf
                                         <div class="form-group mb-1 row">
                                             <label class="col-md-3">Token Number</label>
                                             <div class="col-md-9">
                                                 <input id="ticket"
                                                     class="form-control  @error('ticket') is-invalid @enderror" required
                                                     name="ticket" minlength="13" maxlength="13"
                                                     value="{{ $file->ticket }}" readonly>
                                                 @error('ticket')
                                                     <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong>
                                                     </span>
                                                 @enderror
                                             </div>
                                         </div>
                                         <div class="form-group mb-2">
                                             <label>Line Ministry</label>
                                             <select id="carder" name="ministry" required
                                                 class="form-control select2 @error('ministry') is-invalid @enderror">
                                                 <option value="">Select Ministry</option>
                                                 @foreach ($carders as $item)
                                                     <option value="{{ $item->id }}"
                                                         @if ($item->id == $file->carderId) selected @endif>
                                                         {{ $item->carderName }}
                                                     </option>
                                                 @endforeach
                                             </select>
                                             @error('ministry')
                                                 <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                 </span>
                                             @enderror
                                         </div>
                                         <div class="form-group mb-2">
                                             <label>Carder Name(s)</label>
                                             <?php
                                             $carders = explode(',', $file->carderName); ?>
                                             <select id="cardername" name="cardername[]"
                                                 class="form-control select2 @error('cardername') is-invalid @enderror"
                                                 multiple required>
                                                 @foreach ($carder as $item)
                                                     <option value="{{ $item }}"
                                                         @if (in_array($item, $carders)) selected @endif>
                                                         {{ $item }}
                                                     </option>
                                                     <option value="">Select Carder</option>
                                                 @endforeach
                                             </select>
                                             @error('cardername')
                                                 <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                 </span>
                                             @enderror
                                         </div>
                                         <div id="filedisplay">
                                             <div class="form-group row mb-1 ">
                                                 <label class="col-md-3">Excel File</label>
                                                 <div class="col-md-9" style="display: flex; align-items: center;">
                                                     <a href="#"><i class="fa fa-file-excel"
                                                             style="color: green; font-size:30px;"></i>
                                                         &nbsp; &nbsp;<span
                                                             style="font-size: 26px;">{{ $finalEXCEL }}</span></a>
                                                 </div>
                                             </div>
                                             <div class="form-group row mb-1 ">
                                                 <label class="col-md-3">PDF File</label>
                                                 <div class="col-md-9" style="display: flex; align-items: center;">
                                                     <a href="#"><i class="fa fa-file-pdf"
                                                             style="color: red; font-size:30px;"></i>
                                                         &nbsp; &nbsp;<span
                                                             style="font-size: 26px;">{{ $finalPDF }}</span></a>
                                                 </div>
                                             </div>
                                         </div>
                                         <div id="fileselector">
                                             <div class="form-group mb-2">
                                                 <label>Word File</label><span>(word)</span>
                                                 <input required name="fileupload" type="file"
                                                     class="form-control @error('fileupload') is-invalid @enderror"
                                                     accept=".doc,.docx" value="{{ old('fileupload') }}">
                                                 @error('fileupload')
                                                     <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong>
                                                     </span>
                                                 @enderror
                                             </div>
                                             <div class="form-group mb-2">
                                                 <label>PDF File </label>
                                                 <input required name="pdf" type="file"
                                                     class="form-control @error('pdf')is-invalid @enderror" accept=".pdf"
                                                     value="{{ old('pdf') }}">
                                                 @error('pdf')
                                                     <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong>
                                                     </span>
                                                 @enderror
                                             </div>
                                         </div>
                                         <div class="form-group mb-2">
                                             <label>Ammendment Date<span class="text-sm text-small text-danger">(PS
                                                     Approval Date)</span> </label>
                                             <input required name="approvaldate" type="date"
                                                 class="form-control @error('approvaldate')is-invalid @enderror"
                                                 value="{{ $file->PSDate }}">
                                             @error('approvaldate')
                                                 <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                 </span>
                                             @enderror
                                         </div>
                                         <div class="form-group mb-2">
                                             <label>Document Version </label>
                                             <select name="version" class="form-control select2" required>
                                                 <option>Select Version</option>
                                                 @foreach ($versions as $item)
                                                     <option value="{{ $item->id }}"
                                                         @if ($item->id == $file->versionId) selected @endif>
                                                         {{ $item->versionname }}</option>
                                                 @endforeach
                                             </select>

                                             @error('version')
                                                 <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                 </span>
                                             @enderror
                                         </div>
                                         <div class="form-group mb-2">
                                            <?php
                                             $uploaddate = \Carbon\Carbon::parse($file->UploadDate)->format('M d, Y');
                                             $psdate = \Carbon\Carbon::parse($file->PSDate)->format('d/m/YY');
                                             $update = \Carbon\Carbon::parse($file->UpDate)->format('M d, Y');
                                             $admindate = \Carbon\Carbon::parse($file->ADMINApproval)->format('M d, Y');

                                             $Yr = explode('_', $file)[3];
                                             $Month = explode('_', $file)[2];
                                             $SFSize = Number::fileSize(File::size('storage/Jobs/' . $Yr . '/' . $Month . '/SFiles/' . $file->SUPPORT));
                                             $ext = File::extension('storage/Jobs/' . $Yr . '/' . $Month . '/SFiles/' . $file->SUPPORT);
                                             $SFFile = explode('_', $file->SUPPORT)[5];
                                             ?>
                                             <label>Do you have Suport files?</label>
                                             <span class="float-right mr-5" style="display:inline">
                                                 <label><input id="sfyes" type="radio" value="1"  @if( $file->sfresponse ==1) checked @endif
                                                         name="sf" required style="width: 20px;height:20px">
                                                     &nbsp;YES</label>
                                                 <label><input id="sfno" type="radio" value="0"  @if( $file->sfresponse ==0) checked @endif
                                                         name="sf" style="width: 20px;height:20px" required>
                                                     &nbsp;NO</label>
                                             </span>
                                         </div>
                                         @if ($file->sfresponse ==1)
                                             <div id="sfdisplay">
                                                 <div class="form-group row mb-1 ">
                                                     <label class="col-md-3">Support File</label>
                                                     <div class="col-md-9" style="display: flex; align-items: center;">
                                                         <a href="#">
                                                             @if ($ext == 'pdf')
                                                                 <i class="fa fa-file-pdf"
                                                                     style="color: red; font-size:30px;"></i>
                                                             @elseif($ext == 'doc' || $ext == 'docx')
                                                                 <i class="fa fa-file-word"
                                                                     style="color: blue; font-size:30px;"></i>
                                                             @endif
                                                             &nbsp; &nbsp;<span
                                                                 style="font-size: 26px;">{{ $SFFile }}</span>
                                                         </a>
                                                     </div>
                                                 </div>
                                             </div>
                                         @endif

                                         <div id="sfileselect">
                                             <div class="form-group row mb-1">
                                                 <label class="col-md-3">Support File</label>
                                                 <div class="col-md-9">
                                                     <input type="file" name="sfile" class="form-control"
                                                         value="{{ $file->SFile }}">
                                                     @error('sfile')
                                                         <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong>
                                                         </span>
                                                     @enderror
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="form-group mb-1">
                                             <label>Comment </label>
                                             <textarea name="comment" id="sumz" class="summernote @error('comment')is-invalid @enderror">{!! $file->VComment !!}</textarea>
                                             @error('comment')
                                                 <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                 </span>
                                             @enderror
                                         </div>
                                         <div id="uploaderinfo">
                                             <div class="form-group row mb-1">
                                                 <div class="col-md-6">
                                                     <div class="form-group mb-1">
                                                         <label>Uploaded By </label>
                                                         <input type="text" name="uploadedby"
                                                             class="form-control @error('uploadedby')is-invalid @enderror"
                                                             value="{{ $file->sname }} {{ $file->fname }} {{ $file->oname }}"
                                                             readonly>
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
                                                             value="{{ $file->UploadDate }}" readonly>
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
                                                         required name="status" disabled>
                                                         <option>Select status</option>
                                                         @foreach ($status as $key => $item)
                                                             <option value="{{ $item->id }}"
                                                                 @if ($file->status == $item->id) selected @endif>
                                                                 {{ $item->statusName }}
                                                             </option>
                                                         @endforeach
                                                     </select>
                                                     @error('status')
                                                         <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong>
                                                         </span>
                                                     @enderror
                                                 </div>
                                             </div>
                                         </div>

                                         <div id="userAction" class="form-group mt-2">
                                             <button id="btnCancelUser" type="reset"
                                                 class="btn btn-outline-primary ">Cancel</button>
                                             <button type="submit"
                                                 class="btn  btn-outline-success float float-right">Update</button>
                                         </div>
                                     </form>

                                 </div>
                             </div>
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
                                                         <input readonly type="text" name="uploadedby"
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
                                                         <input readonly type="date" name="uploadedOn"
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
                                                         <input readonly type="text" name="uploadedby"
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
                                                         <input readonly type="date" name="uploadedOn"
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
                                                         <input readonly type="text" name="uploadedby"
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
                                                         <input readonly type="date" name="uploadedOn"
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
                                                         <input readonly type="text" name="uploadedby"
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
                                                         <input readonly type="date" name="uploadedOn"
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
                                                 <textarea id="rejection" class="form-control summernote-simple" name='reason'>
                                            </textarea>
                                             </div>
                                             <div class="form-group mt-1">
                                                 <button id="btnCancelAdmin" type="reset"
                                                     class="btn btn-outline-primary ">Cancel</button>
                                                 <button type="submit"
                                                     class="btn  btn-outline-success float float-right">Reject</button>
                                             </div>
                                         </div>

                                     </form>
                                     {{-- reason --}}

                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </section>
     </div>
 @endsection
 @section('scripts')
     <script>
         // varibale declaration
         var userAction = document.getElementById('userAction');
         var adminAction = document.getElementById('adminAction');
         var votecode = document.getElementById('votecode');
         var filedisplay = document.getElementById('filedisplay');
         var fileselector = document.getElementById('fileselector');
         var sfiledisplay = document.getElementById('sfiledisplay');
         var psdate = document.getElementById('psdate');
         var version = document.getElementById('version');
         var uploaderinfo = document.getElementById('uploaderinfo');
         var summernote3 = document.getElementById('sumz');
         // initially hide the userAction and adminAction sections
         userAction.style.display = 'none';
         adminAction.style.display = 'none';
         adminAction.style.display = 'none';
         fileselector.style.display = 'none';
         sfileselect.style.display = 'none';
         $('#sumz').summernote('disable', true);






         // show the userAction and adminAction sections when the header edit button is clicked
         // header edit button
         document.getElementById('headerEdit').addEventListener('click', function() {
             //  Show the userAction and adminAction sections
             userAction.style.display = 'block';
             fileselector.style.display = 'block';
             sfileselect.style.display = 'block';
             uploaderinfo.style.display = 'none';
             votecode.removeAttribute('disabled');
             psdate.removeAttribute('readonly');
             version.removeAttribute('disabled');
             $('#sumz').summernote('enable', true);
         })
         // user action cancel button
         document.getElementById('btnCancelUser').addEventListener('click', function() {
             // Hide the userAction and adminAction sections
             userAction.style.display = 'none';
             fileselector.style.display = 'none';
             filedisplay.style.display = 'block';
             uploaderinfo.style.display = 'block';
             votecode.setAttribute('disabled', true);
             psdate.setAttribute('readonly', true);
             version.setAttribute('disabled', true);
             $('#sumz').summernote('disable', true);
         })
         // admin action reject button
         document.getElementById('headerReject').addEventListener('click', function() {
             // Show the adminAction section
             adminAction.style.display = 'block';
             $('#rejection').summernote({
                 height: 200,
                 toolbar: [
                     ['style', ['bold', 'italic', 'underline', 'clear']],
                     ['font', ['strikethrough', 'superscript', 'subscript']],
                     ['fontsize', ['fontsize']],
                     ['color', ['color']],
                     ['para', ['ul', 'ol', 'paragraph']],
                     ['height', ['height']]
                 ]
             });

         })
         // admin action cancel button
         document.getElementById('btnCancelAdmin').addEventListener('click', function() {
             // Hide the adminAction section
             adminAction.style.display = 'none';
         });
     </script>
 @endsection
