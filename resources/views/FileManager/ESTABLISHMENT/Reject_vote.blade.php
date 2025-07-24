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
             $PDFsize = Number::fileSize(File::size('storage/Votes/' . $Yr . '/' . $Month . '/PSPDF/' . $file->PDF));
             $finalPDF = explode('_', $file->PDF)[5];

             $EXCELsize = Number::fileSize(File::size('storage/Votes/' . $Yr . '/' . $Month . '/Excel/' . $file->EXCEL));
             $finalEXCEL = explode('_', $file->EXCEL)[5];

             ?>
             <div class="section-header">
                 <h1>Viewing Details of {{ $file->VCode }} - {{ $file->VName }}</h1>
             </div>
             <div class="section-body">
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
                     <div class="row">
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
                             <div class="form-group">
                                 <div><label>Comment</label></div>
                                 <div>
                                     <textarea class="form-control summernote-simple">
                                                 {{ $file->VComment }}
                                            </textarea>
                                 </div>

                             </div>
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
                 </div>
             </div>
     </div>
     </section>
     </div>
 @endsection
 @section('script')
 @endsection
