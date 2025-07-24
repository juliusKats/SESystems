 @extends('NEW.AUTH.layout')
 @section('page_title')
     Vote Details
 @endsection
 @section('content')

     <div class="main-content">
         <section class="section">
             <?php
             $uploaddate = \Carbon\Carbon::parse($file->UploadDate)->format('M d, Y');
             $psdate = \Carbon\Carbon::parse($file->PSDate)->format('M d, Y');
             $createdate = \Carbon\Carbon::parse($file->CrDate)->format('M d, Y');
             $update = \Carbon\Carbon::parse($file->UpDate)->format('M d, Y');
             $admindate = \Carbon\Carbon::parse($file->ADMINApproval)->format('M d, Y');

             $Yr = explode('_', $file)[3];
             $Month = explode('_', $file)[2];
             $PDFsize = Number::fileSize(File::size('storage/Jobs/' . $Yr . '/' . $Month . '/PSPDF/' . $file->PDF));
             $finalPDF = explode('_', $file->PDF)[5];
             if ($file->ext == 'pdf') {
                 $EXCELsize = Number::fileSize(File::size('storage/Jobs/' . $Yr . '/' . $Month . '/JDPDF/' . $file->EXCEL));
                 $finalEXCEL = explode('_', $file->EXCEL)[5];
             } else {
                 $EXCELsize = Number::fileSize(File::size('storage/Jobs/' . $Yr . '/' . $Month . '/JDDOC/' . $file->EXCEL));
                 $finalEXCEL = explode('_', $file->EXCEL)[5];
             }
             ?>
             <div class="section-header">
                 <h1>Viewing Details of {{ $file->ministry }} - {{ $file->carderName }}</h1>
             </div>

             <div class="section-body">
                 <div class="row">
                     <div class="col-md-1"></div>
                     <div class="col-md-10">
                         <div class="card card-body">
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
                             <div class="row">
                                 <div class="col-md-6">
                                     <div class="form-group row">
                                         <label class="col-md-3">Ministry</label>
                                         <div class="col-md-9">
                                             <input type="text" value="{{ $file->ministry }}" readonly name="ministry"
                                                 class="form-control">
                                         </div>
                                     </div>
                                      <div class="form-group">
                                         <label>Carder Name(s)</label>
                                         <div style=" align-items: normal; align-self: self-start;">
                                             <?php $carders = explode(',', $file->CarderName);
                                             ?>
                                             <ul>
                                                 @foreach ($carders as $carder)
                                                     <li class="btn btn-info btn-sm mt-1"> {{ $carder }}</li>
                                                 @endforeach
                                             </ul>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <label>User Comment</label>
                                         <textarea id="summernote2" class="form-control summernote-simple">
                                                 {{ $file->VComment }}
                                            </textarea>
                                     </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                         <label>Uploaded Documents</label>
                                         <div style=" align-items: normal; align-self: self-start;">
                                             <div>
                                                 <a href="{{ route('preview.ps.file', $file->id) }}"
                                                     title="Preview {{ $file->PDF }}" style="font-size: 20px;"
                                                     target="_blank">
                                                     <i style="color: red; font-size: 30px;" class="fas fa-file-pdf"></i>
                                                     {{ $finalPDF }}
                                                     &nbsp;&nbsp; -{{ $PDFsize }}
                                                 </a>
                                             </div>

                                             <a href="{{ route('preview.excel.file', $file->id) }}"
                                                 title="Preview {{ $finalEXCEL }}" style="font-size: 20px;"
                                                 target="_blank">
                                                 @if ($file->ext == 'pdf')
                                                     <i style="color: red; font-size: 30px;" class="fa fa-file-pdf"></i>
                                                 @else
                                                     <i style="color: blue; font-size: 30px;" class="fa fa-file-word"></i>
                                                 @endif
                                                 {{ $finalEXCEL }}
                                                 &nbsp;&nbsp; -{{ $EXCELsize }}
                                             </a>
                                         </div>
                                     </div>
                                     <div class="form-group row">
                                         <label class="col-md-3">PS Date On</label>
                                         <div class="col-md-9">
                                         <input type="text" value="{{ $psdate }}" readonly class="form-control">
                                         </div>
                                     </div>
                                     <div class="form-group row">
                                         <label class="col-md-3">Uploaded By</label>
                                         <div class="col-md-9">
                                             <input type="text"
                                                 value="{{ $file->sname }} {{ $file->fname }} {{ $file->oname }}"
                                                 readonly class="form-control">
                                         </div>
                                     </div>

                                     <div class="form-group row">
                                         <label class="col-md-3">UploadDate</label>
                                         <div class="col-md-9">
                                         <input type="text" value="{{ $uploaddate }}" readonly class="form-control">

                                        </div>
                                     </div>


                                 </div>

                             <div class="row">
                                 <div class="col-md-12">
                                     <form method="post" action="{{ route('job.reject.save', $file->id) }}">
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
                                             <input type="submit" class="btn btn-success" value="Reject">
                                             <a href="{{ route('job.file.list') }}"  class="btn btn-danger float-right">Cancel</a>
                                         </div>
                                     </form>
                                 </div>
                             </div>
                             </div>
                         </div>
                         <div class="col-md-1"></div>
                     </div>

                 </div>
         </section>
     </div>
 @endsection
 @section('script')
 @endsection
