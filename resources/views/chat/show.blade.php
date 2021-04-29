@extends('layouts.app')

@push('styles')
<style type="text/css">
   
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Chat</div>

                <div class="card-body">
                  
                  <div class="row p-2">
                      <div class="col-10">
                            <div class="row">
                                <div class="col-12 border rounded-lg p-3">
                                    <ul id="messages" 
                                        class="list-unstyled overflow-auto"
                                        style="height: 45vh"
                                        >
                                        <li>test1: hello</li>
                                        <li>test2: hiii!!</li>
                                    </ul>
                                </div>
                            </div>
                            <form>
                                <div class="row py-3">
                                    <div class="col-10">
                                        <input type="text" id="message" class="form-control">
                                    </div>
                                    <div class="col-2">
                                        <button type="submit" id="send" class="btn btn-primary btn-block"> send</button>
                                    </div>
                                </div>

                            </form>
                      </div>
                      <div class="col-2">
                            <p><strong> Online Now</strong></p>
                            <ul 
                            id="users"
                            class="list-unstyled overflow-auto text-info"
                            style="heigth: 45vh">
                                <li>test1</li>
                                <li>test2</li>
                            </ul>
                      </div>
                  </div>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        const userElement = document.getElementById('users')

        Echo.join('chat')
        .here((users) => {
                users.forEach(user, index) => {
                    let element  = document.createElement('id')

                    element.setAttribute('id', user.id)
                    element.innerText = user.name
                    userElement.appendChild(element)
                }
        })
        .joining((user) => {
            let element  = document.createElement('li')
            element.setAttribute('id', user.id)
            element.innerText = user.name
            userElement.appendChild(element)
        })
        .living((user) => {
           let element = document.getElementById('user.id')
           element.parentNode.removeChild(element) 
        })
    </script>
@endpush
