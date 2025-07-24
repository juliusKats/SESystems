 @extends('NEW.NON.layout')
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
                     <div class="row">
                         <div class="col-md-6">
                             <div class="form-group row">
                                 <div class="col-md-4">Vote Code</div>
                                 <div class="col-md-8">{{ $file->VCode }}</div>
                             </div>
                             <div class="form-group row">
                                 <div class="col-md-4">Vote Name</div>
                                 <div class="col-md-8">{{ $file->VName }}</div>
                             </div>
                             <div class="form-group row">
                                 <div class="col-md-4">UPLOADED BY</div>
                                 <div class="col-md-8"><a href="#">{{ $file->Name }}</a></div>
                             </div>
                             <div class="form-group row">
                                 <div class="col-md-4">UPLOADED ON</div>
                                 <div class="col-md-8">{{ $uploaddate }}</div>
                             </div>
                             <div class="form-group row">
                                 <div class="col-md-4">Vote File</div>
                                 <div class="col-md-8">
                                     <a href="{{ route('preview.excel.file', $file->id) }}"
                                         title="Preview {{ $finalEXCEL }}" style="font-size: 20px;" target="_blank">
                                         <i style="color: green; font-size: 30px;" class="fas fa-file-excel"></i>
                                         {{ $finalEXCEL }}
                                         &nbsp;&nbsp; -{{ $EXCELsize }}
                                     </a>
                                 </div>
                             </div>
                             <div class="form-group row">
                                 <div class="col-md-4">PS Approved File</div>
                                 <div class="col-md-8">
                                     <a href="{{ route('preview.ps.file', $file->id) }}" title="Preview {{ $file->PDF }}"
                                         style="font-size: 20px;" target="_blank">
                                         <i style="color: red; font-size: 30px;" class="fas fa-file-excel"></i>
                                         {{ $finalPDF }}
                                         &nbsp;&nbsp; -{{ $PDFsize }}
                                     </a>
                                 </div>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <div>Comment</div>
                                 <div>
                                     <textarea class="form-control summernote-simple">
                                                 {{ $file->VComment }}
                                            </textarea>
                                 </div>
                             </div>
                             <div class="form-group row">
                                 <div class="col-md-4">PS File Approve Date</div>
                                 <div class="col-md-8">{{ $psdate }}</div>
                             </div>

                         </div>
                     </div>
                     <div class="row">
                         <div class="col-md-6">
                             <div class="form-group row">
                                 <div class="col-md-4">File Approved?</div>
                                 <div class="col-md-8">
                                     @if ($file->Approve)
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
                         <div class="col-md-6">
                             <div class="form-group row">
                                 <div class="col-md-4">Admin Approval Date</div>
                                 <div class="col-md-8">{{ $admindate }}</div>
                             </div>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-md-6">
                             <div class="form-group row">
                                 <div class="col-md-4">Approved By</div>
                                 <div class="col-md-8">
                                     <a href="#">{{ $file->UpprovedBy }}</a>
                                 </div>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="row">
                                 <div class="col-md-6">
                                     <div class="form-group row">
                                         <div class="col-md-5">Updated On</div>
                                         <div class="col-md-7">{{ $update }}</div>
                                     </div>
                                 </div>
                                 <div class="col-md-6">
                                     <div class="form-group row">
                                         <div class="col-md-5">Updated By</div>
                                         <div class="col-md-7">{{ $file->UpdatedBy }}</div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </section>
     </div>
 @endsection
 @section('script')
 @endsection
