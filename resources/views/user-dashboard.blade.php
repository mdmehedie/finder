<section class="container">
    <div class="card center-card">
        <div class="card-body">
            <div class="">
                <div class="row">
                    <div class="col-md-6">
                        <div style="margin-right: 1rem">
                            <form method="POST" action="{{ route("submit.text") }}">
                                @csrf
                                <textarea class="form-control" id="inputText" rows="10" placeholder="Type or Paste any Text"></textarea>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="border rounded rounded-lg ml-2 p-2" id="result" style="height: 100%">

                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4 text-center">
                <button type="button" id="sendData" class="btn btn-sm px-5 btn-outline-dark">Submit</button>
            </div>
        </div>
    </div>
</section>
