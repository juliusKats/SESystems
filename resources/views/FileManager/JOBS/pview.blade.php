{{ $file }}
[{"id":1,
"ticket":"6128881641045",
"carderId":2,
"cardname":" Presidential Advisors",
"versionname":"Version 5",
"versionId":5,
"carderName":"Office of the President ",
"Draft":0,
"CarderName":"Disaster Management Officers,Economists (Monitoring and evaluation)",
"EXCEL":"Tue_12_Aug_2025_1754962255_28_Jul_2025_1753693937_h.docx",
"ext":"docx",
"PDF":"Tue_12_Aug_2025_1754962255_2024 (1).pdf",
"SUPPORT":null,
"PSDate":"2025-08-07",
"VComment":"<p>jkjkj<\/p>\n",
"created_at":"2025-08-12T01:30:55.000000Z",
    "updated_at":"2025-08-12T01:30:55.000000Z",

    "deleted_at":null,
    "DeletedBy":null,
    "RestoredBy":null,
    {{-- "UploadDate":"2025-08-12 04:30:55", --}}
    "sname":"Mops",
    "fname":"Admin",
    "UpprovedBy":null,
    "UpdatedBy":null,
    "approved_by":null,
    "statusName":"Active",
    "ADMINApproval":null,

    "RejectedBy":null,
    "Reason":null}]


     <?php
             $update="me";
             $uploaddate = \Carbon\Carbon::parse($file->UpOn)->format('M d, Y');
             $psdate = \Carbon\Carbon::parse($file->PSDate)->format('d/m/YY');
             $createdate = \Carbon\Carbon::parse($file->CrDate)->format('d/m/Y');
             $update = \Carbon\Carbon::parse($file->UpDate)->format('M d, Y');
             $admindate = \Carbon\Carbon::parse($file->ADMINApproval)->format('M d, Y');

             $Yr = explode('_', $file)[3];
             $Month = explode('_', $file)[2];
             $PDFsize = Number::fileSize(File::size('storage/Jobs/' . $Yr . '/' . $Month . '/PSPDF/' . $file->PDF));
             $finalPDF = explode('_', $file->PDF)[5];

             $EXCELsize = Number::fileSize(File::size('storage/Jobs/' . $Yr . '/' . $Month . '/JDDOC/' . $file->EXCEL));
             $finalEXCEL = explode('_', $file->EXCEL)[5];

             ?>



