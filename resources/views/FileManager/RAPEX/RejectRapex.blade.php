

    <form id="myForm" action="{{ route('your.upload.route') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="product_name" placeholder="Product Name">
        <textarea name="description" placeholder="Description"></textarea>

        <div id="myDropzone" class="dropzone"></div>

        <button  type="submit">Submit Form</button>
    </form>

    <script>
        Dropzone.autoDiscover = false; // Disable auto-discovery if manually initializing

        var myDropzone = new Dropzone("#myDropzone", {
            url: "{{ route('your.upload.route') }}", // Laravel route for handling uploads
            autoProcessQueue: false, // Prevent auto-upload on file selection
            addRemoveLinks: true, // Show remove file links

            init: function() {
                var submitButton = document.querySelector("#myForm button[type='submit']");
                var myDropzone = this; // Closure

                submitButton.addEventListener("click", function(e) {
                    e.preventDefault(); // Stop the form from submitting
                    e.stopPropagation();
                    myDropzone.processQueue(); // Tell Dropzone to process all queued files
                });

                // Event for sending other form data along with files
                this.on("sending", function(file, xhr, formData) {
                    formData.append("product_name", document.querySelector("input[name='product_name']").value);
                    formData.append("description", document.querySelector("textarea[name='description']").value);
                });

                // Optional: Handle success/error events
                this.on("successmultiple", function(files, response) {
                    console.log("Files uploaded successfully:", response);
                    // Handle success, e.g., redirect or show message
                });
                this.on("errormultiple", function(files, response) {
                    console.error("Error uploading files:", response);
                    // Handle errors
                });
            }
        });
    </script>



        // routes/web.php
    Route::post('/upload-product', [ProductController::class, 'uploadProduct'])->name('your.upload.route');

    // app/Http/Controllers/ProductController.php
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Storage;

    class ProductController extends Controller
    {
        public function uploadProduct(Request $request)
        {
            $request->validate([
                'product_name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'file.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate each file
            ]);

            $productName = $request->input('product_name');
            $description = $request->input('description');

            // Process other form fields (e.g., save to database)
            // $product = Product::create(['name' => $productName, 'description' => $description]);

            $uploadedFiles = [];
            if ($request->hasFile('file')) {
                foreach ($request->file('file') as $file) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('public/products', $fileName); // Store in storage/app/public/products
                    $uploadedFiles[] = Storage::url($path); // Get URL for later use
                    // Associate file with product in database
                    // $product->images()->create(['path' => $path]);
                }
            }

            return response()->json(['message' => 'Product and files uploaded successfully!', 'files' => $uploadedFiles]);
        }
    }








   