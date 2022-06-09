@extends('layouts.main-layout')
@section('title', 'Заметки - Note')
@section('content')
<div class="container-fluid">
  <div class="row">

    <div class="col-xl-1 col-md-2 col-3">
      <div class="sidebar d-inline-flex d-flex flex-column justify-content-between sticky-top">  
        <div class="sidebar bg-white rounded-3 shadow-sm d-flex flex-column justify-content-between mt-4">   
        
          <div class="d-inline-flex d-flex flex-column justify-content-between">

            <div class="logo border-bottom d-inline-flex d-flex align-items-center flex-column p-3">
              <a href="{{route('index')}}"><img class="icon" src="/img/logo.png" alt="" data-bs-toggle="tooltip" data-bs-placement="right" title="Главная"></a>
            </div>

            <div class="border-bottom d-inline-flex d-flex align-items-center flex-column p-3">
              <div class="dropdown">
                <a class="d-flex align-items-center justify-content-center link-dark text-decoration-none" id="dropdownAdd" data-bs-toggle="dropdown" aria-expanded="false">
                  <img class="icon add" src="/img/add.png" alt="" data-bs-toggle="tooltip" data-bs-placement="right" title="Добавить">
                </a>
                <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownAdd" style="">
                  <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#AddNoteModal">Заметка</a></li>
                  <li><a class="dropdown-item border-top" data-bs-toggle="modal" data-bs-target="#AddListModal">Список</a></li>
                </ul>
              </div>
            </div>


            <div class="border-bottom d-inline-flex d-flex align-items-center flex-column p-3">
              <img class="icon mb-4 notes" src="/img/notes.png" alt="" data-bs-toggle="tooltip" data-bs-placement="right" title="Заметки">
              <div class="dropdown">
                <a class="d-flex align-items-center justify-content-center link-dark text-decoration-none mb-4" id="dropdownTag" data-bs-toggle="dropdown" aria-expanded="false">
                  <img class="icon tags" src="/img/tag.png" alt="" data-bs-toggle="tooltip" data-bs-placement="right" title="Категории">
                </a>
                <ul class="dropdown-menu text-small shadow" id="FetchTags" aria-labelledby="dropdownTag" style="">
                  {{-- Tags --}}
                </ul>
              </div>
              <img class="icon mb-4 archived" src="/img/archive.png" alt="" data-bs-toggle="tooltip" data-bs-placement="right" title="Архив">
              <img class="icon deleted" src="/img/delete.png" alt="" data-bs-toggle="tooltip" data-bs-placement="right" title="Корзина">
            </div>

          </div>

          <div class="border-top d-inline-flex d-flex align-items-center flex-column justify-content-between">


            <div class="d-inline-flex d-flex align-items-center flex-column p-3">
              <div class="dropdown">
                <a class="d-flex align-items-center justify-content-center link-dark text-decoration-none" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="/img/profile.png" alt="img" class="icon rounded-circle" data-bs-toggle="tooltip" data-bs-placement="right" title="Профиль">
                </a>
                <ul class="dropdown-menu rounded-3 text-small shadow" aria-labelledby="dropdownUser" style="">
                  <li class="d-flex justify-content-center mt-2"><img src="/img/profile.png" alt="img" width="80" height="80" class="rounded-circle"></li>
                  <li class="d-flex justify-content-center px-3 pt-2"><h6>{{ Auth::user()->name }}</h5></li>
                  <li><a class="dropdown-item border-top">Настройки</a></li>
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                  <li><a class="dropdown-item border-top" href="logout" 
                  onclick="event.preventDefault();
                    this.closest('form').submit();">Выйти</a></li>
                </form>
                </ul>
              </div>
            </div>
          </div>
        
        </div>
      </div>
    </div>

    <div class="col-xl-11 col-md-10 col-9 mt-4"> 
      <div id="success_message"></div>
      <div class="row" id="FetchNotes" data-masonry='{"percentPosition": true }'>  

       {{--  <div class="col-xxl-3 col-xl-4 col-md-6 col-sm-12 col-12 mb-4">
          <div class="card rounded-3 shadow-sm edit_note" value="100">
            <div class="card-body"> 
              <h5 class="card-title">Заголовок...</h5>
              <h6 class="card-subtitle mb-2 text-muted">Заголовок...</h6>
              <p class="card-text">Заметка...</p>
            </div>
            <div class="card-tag-list border-top">
              <div class="card-tag tag-red shadow-sm">Развитие</div>
              <div class="card-tag tag-pink shadow-sm">Структура</div>
              <div class="card-tag tag-purple shadow-sm">Структура</div>
              <div class="card-tag tag-violet shadow-sm">Степень</div>
              <div class="card-tag tag-blue shadow-sm">Организация</div>
              <div class="card-tag tag-light-blue shadow-sm">Практика</div>
              <div class="card-tag tag-turquoise shadow-sm">Форма</div>
              <div class="card-tag tag-green shadow-sm">Усилиля</div>
              <div class="card-tag tag-light-green shadow-sm">Опыт</div>
              <div class="card-tag tag-yellow shadow-sm">Способы</div>
              <div class="card-tag tag-orange shadow-sm">Пути</div>
            </div>
          </div>
        </div>
 
        <div class="col-xxl-3 col-xl-4 col-md-6 col-sm-12 col-12 mb-4">
          <div class="card rounded-3 shadow-sm edit_note" value="100">
            <div class="card-body"> 
              <h5 class="card-title">Cтороны постоянное</h5>
              <h6 class="card-subtitle mb-2 text-muted"></h6>
              <p class="card-text">С другой стороны постоянное информационно-пропагандистское обеспечение нашей деятельности представляет собой интересный эксперимент проверки модели развития. </p>
            </div>
            <div class="card-tag-list border-top">
              <div class="card-tag tag-red shadow-sm">Развитие</div>
              <div class="card-tag tag-light-blue shadow-sm">Практика</div>
              <div class="card-tag tag-orange shadow-sm">Пути</div>
            </div>
          </div>
        </div>

        <div class="col-xxl-3 col-xl-4 col-md-6 col-sm-12 col-12 mb-4">
          <div class="card rounded-3 shadow-sm edit_note" value="1000">
            <ul class="list-group list-group-flush">
              <li class="list-group-title"><h5>Список дел</h5></li>
              <li class="list-group-item">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                <label class="form-check-label checked" for="flexCheckChecked">
                  Купить продукты
                </label>
              </li>
              <li class="list-group-item">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                <label class="form-check-label" for="flexCheckChecked">
                  Приготовить ужин
                </label>
              </li>
              <li class="list-group-item">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                <label class="form-check-label" for="flexCheckChecked">
                  Сделать уборку
                </label> 
              </li>
            </ul>
            <div class="card-tag-list border-top">
            </div>
          </div>
        </div>

        <div class="col-xxl-3 col-xl-4 col-md-6 col-sm-12 col-12 mb-4">
          <div class="card rounded-3 shadow-sm edit_note" value="100">
            <img src="/img/notes-img3.jpg" class="card-img shadow-sm" alt="...">
            <div class="card-body"> 
              <h5 class="card-title">Форма</h5>
              <h6 class="card-subtitle mb-2 text-muted">Практика</h6>
              <p class="card-text">Повседневная практика показывает, что укрепление и развитие структуры требуют от нас анализа новых предложений. Таким...</p>
            </div>
            <div class="card-tag-list border-top">
              <div class="card-tag tag-pink shadow-sm">Практика</div>
            </div>
          </div>
        </div>

        <div class="col-xxl-3 col-xl-4 col-md-6 col-sm-12 col-12 mb-4">
          <div class="card rounded-3 shadow-sm edit_note" value="1000">
            <img src="/img/notes-img6.jpg" class="card-img shadow-sm" alt="...">
            <ul class="list-group list-group-flush">
              <li class="list-group-title"><h5>Список покупок</h5></li>
              <li class="list-group-item">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                <label class="form-check-label checked" for="flexCheckChecked">
                  600 гр говядины
                </label>
              </li>
              <li class="list-group-item">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                <label class="form-check-label checked" for="flexCheckChecked">
                  Лук, морковь, картофель, томаты, перец
                </label>
              </li>
              <li class="list-group-item">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                <label class="form-check-label checked" for="flexCheckChecked">
                  Специи
                </label> 
              </li>
            </ul>
            <div class="card-tag-list border-top">
              <div class="card-tag tag-light-green shadow-sm">Продукты</div>
            </div>
          </div>
        </div>

        <div class="col-xxl-3 col-xl-4 col-md-6 col-sm-12 col-12 mb-4">
          <div class="card rounded-3 shadow-sm edit_note" value="1000">
            <div class="card-body"> 
              <h5 class="card-title">Форма</h5>
              <h6 class="card-subtitle mb-2 text-muted">Форма развития</h6>
              <p class="card-text">С другой стороны постоянный количественный рост и сфера нашей активности позволяет выполнять важные задания по разработке форм развития. Таким образом...</p>
            </div>
            <div class="card-tag-list border-top">
              <div class="card-tag tag-light-blue shadow-sm">Практика</div>
              <div class="card-tag tag-turquoise shadow-sm">Форма</div>
            </div>
          </div>
        </div>

        <div class="col-xxl-3 col-xl-4 col-md-6 col-sm-12 col-12 mb-4">
          <div class="card rounded-3 shadow-sm edit_note" value="1000">
            <div class="card-body"> 
              <h5 class="card-title">Организация структуры</h5>
              <h6 class="card-subtitle mb-2 text-muted">Начало</h6>
              <p class="card-text">Не следует, однако забывать, что сложившаяся структура организации представляет собой интересный эксперимент проверки модели развития. Значимость этих проблем настолько очевидна,...</p>
            </div>
            <div class="card-tag-list border-top">
              <div class="card-tag tag-red shadow-sm">Развитие</div>
              <div class="card-tag tag-violet shadow-sm">Степень</div>
            </div>
          </div>
        </div>

        <div class="col-xxl-3 col-xl-4 col-md-6 col-sm-12 col-12 mb-4">
          <div class="card rounded-3 shadow-sm edit_note" value="1000">
            <img src="/img/notes-img2.jpg" class="card-img shadow-sm" alt="...">
            <div class="card-body"> 
              <h5 class="card-title">Обучения кадров</h5>
              <h6 class="card-subtitle mb-2 text-muted">Подготовка</h6>
              <p class="card-text">Равным образом рамки и место обучения кадров способствует подготовки и реализации позиций, занимаемых участниками в отношении поставленных задач. Разнообразный и...</p>
            </div>
            <div class="card-tag-list border-top">
              <div class="card-tag tag-blue shadow-sm">Организация</div>
            </div>
          </div>
        </div>

        <div class="col-xxl-3 col-xl-4 col-md-6 col-sm-12 col-12 mb-4">
          <div class="card rounded-3 shadow-sm edit_note" value="1000">
            <img src="/img/notes-img4.jpg" class="card-img shadow-sm" alt="...">
            <div class="card-body"> 
              <h5 class="card-title">Заголовок...</h5>
              <h6 class="card-subtitle mb-2 text-muted">Заголовок...</h6>
              <p class="card-text">Заметка...</p>
            </div>
            <div class="card-tag-list border-top">
              <div class="card-tag tag-blue shadow-sm">Организация</div>
              <div class="card-tag tag-green shadow-sm">Усилиля</div>
            </div>
          </div>
        </div>  --}}

        {{-- Notes --}}

      </div>
    </div>

  </div>
</div>

  {{-- EditListModal --}}
  <div class="modal fade" id="EditListModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md 1modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-body">
          <input type="hidden" id="edit_list_id">
          <h5><div id="edit_list_title" class="title form-control-plaintext" contenteditable="true" data-placeholder="Заголовок" type="text"></div></h5>
          <h6><div id="edit_list_subtitle" class="subtitle text-muted form-control-plaintext" contenteditable="true" data-placeholder="Подзаголовок..." type="text"></div></h6>
          <div id="edit_list_content" class="content form-control-plaintext" contenteditable="true" data-placeholder="Заметка..." type="text"></div>   
        </div>
        <div class="modal-footer d-flex justify-content-between border-top">
          <div class="d-flex">
            <img class="icon me-3" src="/img/img.png" alt="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Добавить фото">
            <div class="dropdown">
              <a class="d-flex align-items-center justify-content-center" id="dropdownEditListSelectTag" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="icon me-3" src="/img/tag.png" alt="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Добавить категорию">
              </a>
              <ul class="dropdown-menu text-small shadow" id="EditListFetchTags" aria-labelledby="dropdownEditListSelectTag" style="">
                
              </ul>
            </div>
            <img class="icon me-3" src="/img/archive.png" alt="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Архивировать">       
            <img class="icon delete_list" src="/img/delete.png" alt="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Удалить заметку">
          </div>
          <div class="d-flex">
            <button type="button" class="btn btn-sm btn-dark me-3 update_list">Обновить</button>
            <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Закрыть</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- End- EditListModal --}}
  
  {{-- AddListModal --}}
  <div class="modal fade" id="AddListModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md 1modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-body">
            <h5><div id="add_list_title" class="title form-control-plaintext" contenteditable="true" data-placeholder="Заголовок..." type="text"></div></h5> 
            <h6><div id="add_list_subtitle" class="subtitle text-muted form-control-plaintext" contenteditable="true" data-placeholder="Подзаголовок..." type="text"></div></h6>     
            <div id="add_list_content" class="content form-control-plaintext" contenteditable="true" data-placeholder="Заметка..." type="text"></div>  
          </div>
          <div class="modal-footer d-flex justify-content-between border-top">
            <div class="d-flex">
              <img class="icon me-3" src="/img/img.png" alt="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Добавить фото">
              <div class="dropdown">
                <a class="d-flex align-items-center justify-content-center" id="dropdownAddListSelectTag" data-bs-toggle="dropdown" aria-expanded="false">
                  <img class="icon me-3" src="/img/tag.png" alt="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Добавить категорию">
                </a>
                <ul class="dropdown-menu text-small shadow" id="AddListFetchTags" aria-labelledby="dropdownAddListSelectTag" style="">
                    
                </ul>
              </div>
              <img class="icon" src="/img/archive.png" alt="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Архивировать">
            </div>
            <div class="d-flex">
              
              <button type="button" class="btn btn-sm btn-dark me-3 add_list">Сохранить</button>
              <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Закрыть</button>

            </div>
          </div>
        </div>
      </div>
  </div>
  {{-- End- AddListModal --}}

  {{-- EditNoteModal --}}
  <div class="modal fade" id="EditNoteModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md 1modal-dialog-scrollable">
      <div class="modal-content">
        <div id="edit_note_photo"></div>

        <div class="modal-body">
          {{-- <ul id="updateform_errList"></ul> --}}
          <input id="edit_note_id" type="hidden">
          <input id="edit_note_archive_value" type="hidden">
          
          <h5><div id="edit_note_title" class="title form-control-plaintext" contenteditable="true" data-placeholder="Заголовок" type="text"></div></h5>
          <h6><div id="edit_note_subtitle" class="subtitle text-muted form-control-plaintext" contenteditable="true" data-placeholder="Подзаголовок..." type="text"></div></h6>
          <div id="edit_note_content" class="content form-control-plaintext" contenteditable="true" data-placeholder="Заметка..." type="text"></div>   
          
          <input id="edit_note_image" class="file-hide mt-2" type="file">
        </div>
        <div class="modal-footer d-flex justify-content-between border-top">
          <div class="d-flex">
            <label for="edit_note_image" class="d-flex align-items-center">
              <img class="icon me-3" src="/img/img.png" alt="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Добавить фото">
            </label>
            <div class="dropdown">
              <a class="d-flex align-items-center justify-content-center" id="dropdownEditNoteSelectTag" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="icon me-3" src="/img/tag.png" alt="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Добавить категорию">
              </a>
              <ul class="dropdown-menu text-small shadow" id="EditNoteFetchTags" aria-labelledby="dropdownEditNoteSelectTag" style="">
                
              </ul>
            </div>
            <div id="edit_note_archive" class="d-flex align-items-center justify-content-center"></div>     
            <img class="icon delete_note" src="/img/delete.png" alt="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Удалить заметку">
          </div>
          <div class="d-flex">
            <button type="button" class="btn btn-sm btn-dark me-3 update_note">Обновить</button>
            <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Закрыть</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- End- EditNoteModal --}}
  
  {{-- AddNoteModal --}}
  <div class="modal fade" id="AddNoteModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md 1modal-dialog-scrollable">
        <div class="modal-content">
          <div id="add_note_photo"></div>

          <div class="modal-body">
            <input id="add_note_archive_value" type="hidden">
            {{-- <ul id="saveform_errList"></ul> --}}
            
            <h5><div id="add_note_title" class="title form-control-plaintext" contenteditable="true" data-placeholder="Заголовок..." type="text"></div></h5> 
            <h6><div id="add_note_subtitle" class="subtitle text-muted form-control-plaintext" contenteditable="true" data-placeholder="Подзаголовок..." type="text"></div></h6>     
            <div id="add_note_content" class="content form-control-plaintext" contenteditable="true" data-placeholder="Заметка..." type="text"></div>  

            <input id="add_note_image" class="file-hide" type="file">
          </div>
          <div class="modal-footer d-flex justify-content-between border-top">
            <div class="d-flex">
              <label for="add_note_image" class="d-flex align-items-center">
                <img class="icon me-3" src="/img/img.png" alt="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Добавить фото">
              </label>
              <div class="dropdown">
                <a class="d-flex align-items-center justify-content-center" id="dropdownAddNoteSelectTag" data-bs-toggle="dropdown" aria-expanded="false">
                  <img class="icon me-3" src="/img/tag.png" alt="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Добавить категорию">
                </a>
                <ul class="dropdown-menu text-small shadow" id="AddNoteFetchTags" aria-labelledby="dropdownAddNoteSelectTag" style="">
                    
                </ul>
              </div>
              <div id="add_note_archive" class="d-flex align-items-center justify-content-center"></div>
              
            </div>
            <div class="d-flex">
              
              <button type="button" class="btn btn-sm btn-dark me-3 add_note">Сохранить</button>
              <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Закрыть</button>

            </div>
          </div>
        </div>
      </div>
  </div>
  {{-- End- AddNoteModal --}}

  {{-- EditTagModal --}}
  <div class="modal fade" id="EditTagModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body">
          {{-- <ul id="updateform_errList"></ul> --}}
          <input type="hidden" id="edit_tag_id">
          <input type="hidden" id="edit_tag_type">
          <h5><div contenteditable="true" data-placeholder="Категория..." type="text" id="edit_tag_name" class="title form-control-plaintext"></div></h5>  
        </div>
        <div class="modal-footer d-flex justify-content-between border-top">
          <div class="d-flex">
            <div class="dropdown me-3">
              <a class="d-flex align-items-center justify-content-center" id="dropdownEditTagSelectTagType" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="" id="edit_tag_circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Цвет категории"></div>
              </a>
              <ul class="dropdown-menu text-small shadow" id="EditFetchTagsTypes" aria-labelledby="dropdownEditTagSelectTagType" style="">
                  
              </ul>
            </div>
            <img class="icon delete_tag" src="/img/delete.png" alt="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Удалить категорию">
          </div>
          <div class="d-flex">
            <button type="button" class="btn btn-sm btn-dark me-3 update_tag">Обновить</button>
            <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Закрыть</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- End- EditTagModal --}}

  {{-- AddTagModal --}}
  <div class="modal fade" id="AddTagModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body">        
          <input type="hidden" id="add_tag_type" value="1">
          <h5><div contenteditable="true" data-placeholder="Категория..." type="text" id="add_tag_name" class="title form-control-plaintext"></div></h5>
        </div>
        <div class="modal-footer d-flex justify-content-between border-top">
          <div class="d-flex">
            <div class="dropdown">
              <a class="d-flex align-items-center justify-content-center" id="dropdownAddTagSelectTagType" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="rounded-circle tag-circle tag-red shadow-sm" id="add_tag_circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Цвет категории"></div>
              </a>
              <ul class="dropdown-menu text-small shadow" id="AddFetchTagsTypes" aria-labelledby="dropdownAddTagSelectTagType" style="">
                  
              </ul>
            </div>
          </div>
          <div class="d-flex">
            <button type="button" class="btn btn-sm btn-dark me-3 add_tag">Сохранить</button>
            <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Закрыть</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- End- AddTagModal --}}
@endsection
 

@section('scripts')

  <script>
      $(document).ready(function () {

        fetchAllNotes();
        fetchAllTags();
        fetchTagsTypes();

        $('body').tooltip({
          selector: '[data-bs-toggle="tooltip"]'
        });
        
        var $container = $("#FetchNotes"); 
        $( document ).ajaxComplete(function() {  
          $( document ).imagesLoaded( function() {      
            $container.masonry('reloadItems').masonry();
          });
        });
         
        

        $('[contenteditable]').on('paste', function (e) { 		
          e.preventDefault();     
          var pastedData = e.originalEvent.clipboardData.getData('text');     
          var selection = window.getSelection().toString();     
        document.execCommand('inserttext', false, pastedData); });

        function fetchArchivedNotes() 
        {
          $.ajax({
            type: "GET",
            url: "/fetch-archived-notes",
            data: "json",
            success: function (response) {
              console.log(response);

              $.each(response.notes, function (key, item) { 
                
                  let tagsDivs = '';
                  let imgDivs = '';
                  
                  const renderTags = (tags) => {
                    tags.forEach((tag) => {
                      tagsDivs += `<div class="card-tag ${tag.tags_type.type} shadow-sm">${tag.name}</div>`;
                    });
                  };
                  
                  const renderImg = () => {
                  if(item.photo){
                    // console.log(item.photo);
                    imgDivs += `<img src="${item.photo}" class="card-img shadow-sm" alt="...">`;
                  }
                  };
                
                  renderTags(item.tags);
                  renderImg();
                                 
                   $('#FetchNotes').append(
                    `<div class="col-xxl-3 col-xl-4 col-md-6 col-sm-12 col-12 mb-4">
                      <div class="card rounded-3 shadow-sm edit_note" value="${item.id}">
                          ${imgDivs}
                        <div class="card-body">
                          <h5 class="card-title">${item.title}</h5>
                          <h6 class="card-subtitle mb-2 text-muted">${item.subtitle}</h6>
                          <p class="card-text">${item.content}</p>
                        </div>
                        <div class="card-tag-list border-top">
                          ${tagsDivs}
                        </div>
                      </div>
                    </div>`
                   );

                });
             
            }
          });

        }

        function fetchDeletedNotes() 
        {
          $.ajax({
            type: "GET",
            url: "/fetch-deleted-notes",
            data: "json",
            success: function (response) {
              console.log(response);

              $.each(response.notes, function (key, item) { 
                
                  let tagsDivs = '';
                  let imgDivs = '';
                  
                  const renderTags = (tags) => {
                    tags.forEach((tag) => {
                      tagsDivs += `<div class="card-tag ${tag.tags_type.type} shadow-sm">${tag.name}</div>`;
                    });
                  };
                  
                  const renderImg = () => {
                  if(item.photo){
                    // console.log(item.photo);
                    imgDivs += `<img src="${item.photo}" class="card-img shadow-sm" alt="...">`;
                  }
                  };
                
                  renderTags(item.tags);
                  renderImg();
                                 
                   $('#FetchNotes').append(
                    `<div class="col-xxl-3 col-xl-4 col-md-6 col-sm-12 col-12 mb-4">
                      <div class="card rounded-3 shadow-sm" value="${item.id}">
                          ${imgDivs}
                        <div class="card-body">
                          <h5 class="card-title">${item.title}</h5>
                          <h6 class="card-subtitle mb-2 text-muted">${item.subtitle}</h6>
                          <p class="card-text">${item.content}</p>
                        </div>
                        <div class="card-tag-list border-top">
                          ${tagsDivs}
                        </div>
                      </div>
                    </div>`
                   );

                });
             
            }
          });

        }

        function fetchAllNotes() 
        {
          $.ajax({
            type: "GET",
            url: "/fetch-all-notes",
            data: "json",
            success: function (response) {
              console.log(response);

              
                $.each(response.notes, function (key, item) { 

                  let tagsDivs = '';
                  let imgDivs = '';
                  
                  const renderTags = (tags) => {
                    tags.forEach((tag) => {
                      tagsDivs += `<div class="card-tag ${tag.tags_type.type} shadow-sm">${tag.name}</div>`;
                    });
                  };
                  
                  const renderImg = () => {
                  if(item.photo){
                    // console.log(item.photo);
                    imgDivs += `<img src="${item.photo}" class="card-img shadow-sm" alt="...">`;
                  }
                  };
                
                  // <img src="/img/notes-img3.jpg" class="card-img shadow-sm" alt="...">
                  renderTags(item.tags);
                  renderImg();
                                 
                   $('#FetchNotes').append(
                    `<div class="col-xxl-3 col-xl-4 col-md-6 col-sm-12 col-12 mb-4">
                      <div class="card rounded-3 shadow-sm edit_note" value="${item.id}">
                          ${imgDivs}
                        <div class="card-body">
                          <h5 class="card-title">${item.title}</h5>
                          <h6 class="card-subtitle mb-2 text-muted">${item.subtitle}</h6>
                          <p class="card-text">${item.content}</p>
                        </div>
                        <div class="card-tag-list border-top">
                          ${tagsDivs}
                        </div>
                      </div>
                    </div>`
                   );

                });

            }
          });

        }

        $(document).on('click', '.notes', function (e) {
        e.preventDefault();
          $('#FetchNotes').html("");
          fetchAllNotes();
        });

        $(document).on('click', '.deleted', function (e) {
        e.preventDefault();
          $('#FetchNotes').html("");
          fetchDeletedNotes();
        });

        $(document).on('click', '.archived', function (e) {
        e.preventDefault();
          $('#FetchNotes').html("");
          fetchArchivedNotes();
        });

        $(document).on('click', '#edit_note_archive_active', function (e) {
        e.preventDefault();
          $('#edit_note_archive_value').val("0");
          $('#edit_note_archive').text("");
          $('#edit_note_archive').append(`
            <img id="edit_note_archive_inactive" class="icon me-3" src="/img/archive-light.png" alt="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Разархивировать">
          `);
          $(".tooltip").tooltip("hide");
        });

        $(document).on('click', '#edit_note_archive_inactive', function (e) {
        e.preventDefault();
          $('#edit_note_archive_value').val("1");
          $('#edit_note_archive').text("");
          $('#edit_note_archive').append(`
            <img id="edit_note_archive_active" class="icon me-3" src="/img/archive.png" alt="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Архивировать">
          `);
          $(".tooltip").tooltip("hide");
        });

        $(document).on('click', '#add_note_archive_active', function (e) {
        e.preventDefault();
          $('#add_note_archive_value').val("0");
          $('#add_note_archive').text("");
          $('#add_note_archive').append(`
            <img id="add_note_archive_inactive" class="icon" src="/img/archive-light.png" alt="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Разархивировать">
          `);
          $(".tooltip").tooltip("hide");
        });

        $(document).on('click', '#add_note_archive_inactive', function (e) {
        e.preventDefault();
          $('#add_note_archive_value').val("1");
          $('#add_note_archive').text("");
          $('#add_note_archive').append(`
            <img id="add_note_archive_active" class="icon" src="/img/archive.png" alt="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Архивировать">
          `);
          $(".tooltip").tooltip("hide");
        });


        $(document).on('click', '.notes_by_tag', function (e) {
        e.preventDefault();

        var id = $(this).attr('value');

        $('#FetchNotes').html("");
          fetchNotesByTag(id);
        });

        $(document).on('change', '#edit_note_image', function (e) {
        e.preventDefault();
          $('#edit_note_photo').html("");
          // $('#edit_note_image').val("");
          $('#edit_note_photo').append(`<img id="edit_note_photo_preview" src="" class="card-img shadow-sm" alt="...">`);
          $('#edit_note_photo').append(`
          <div id="edit_note_delete_img" class="delete_img_btn">
            <img class="icon-sm" src="/img/delete-light.png" alt="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Удалить фото">
          </div>`);
          var reader = new FileReader();
          reader.onload = function (e) {
            var image =  $('#edit_note_photo_preview').attr('src', e.target.result);
          }
          reader.readAsDataURL($('#edit_note_image')[0].files[0]);

        });

        $(document).on('click', '#edit_note_delete_img', function (e) {
        e.preventDefault();
          $('#edit_note_photo').html("");
          $('#edit_note_image').val("");
          $(".tooltip").tooltip("hide");
          // console.log($('#edit_note_image')[0].files[0]);
        });

        $(document).on('change', '#add_note_image', function (e) {
        e.preventDefault();
          $('#add_note_photo').html("");
          // $('#add_note_image').val("");
          $('#add_note_photo').append(`<img id="add_note_photo_preview" src="" class="card-img shadow-sm" alt="...">`);
          $('#add_note_photo').append(`
          <div id="add_note_delete_img" class="delete_img_btn">
            <img class="icon-sm" src="/img/delete-light.png" alt="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Удалить фото">
          </div>`);
          var reader = new FileReader();
          reader.onload = function (e) {
            var image =  $('#add_note_photo_preview').attr('src', e.target.result);
          }
          reader.readAsDataURL($('#add_note_image')[0].files[0]);

        });

        $(document).on('click', '#add_note_delete_img', function (e) {
        e.preventDefault();
          $('#add_note_photo').html("");
          $('#add_note_image').val("");
          $(".tooltip").tooltip("hide");
        });

        $(document).on('click', '.delete_note', function (e) {
          e.preventDefault();
          $(".delete_note").prop('disabled', true);

          var id = $('#edit_note_id').attr('value');

          $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

          $.ajax({
                type: "DELETE",
                url: "/delete-note/"+id,
                success: function (response) {
                  $('#success_message').addClass('alert alert-success');
                  $('#success_message').text(response.message);
                  $('#EditNoteModal').modal('hide');
                  $('#FetchNotes').html("");
                  fetchAllNotes();
                  setTimeout(closeSuccess, 3000);
                }
              });
        });

        $(document).on('click', '.update_note', function (e) {
            e.preventDefault();
            $(".update_note").prop('disabled', true);
            
            var id = $('#edit_note_id').attr('value');
            var archiveId = $('#edit_note_archive_value').attr('value');

            var tags = [];
            $('#EditNoteFetchTags input:checkbox:checked').each(function() {
              tags.push($(this).val());
            });

            var data = {
                'title': $('#edit_note_title').text(), 
                'subtitle': $('#edit_note_subtitle').text(), 
                'content': $('#edit_note_content').text(),
                'tags' : tags,
                'archive' : archiveId,
            }

            //
            // var formData = new FormData();
            // formData.append('photo', $('#edit_note_image')[0].files[0]);
            // formData.append('title', $('#edit_note_title').text());
            // formData.append('subtitle', $('#edit_note_subtitle').text());
            // formData.append('content', $("#edit_note_content").text());
            // formData.append('tags', tags);
            //

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "PUT",
                url: "/update-note/"+id,
                data: data,
                dataType: "json",
                // processData: false,
                // contentType: false,
                success: function (response) {
                  // console.log(response.status);
                  // console.log(response.photo);
                  
                  if(response.status == 400) 
                  {
                    $('#updateform_errList').html("");
                    $('#updateform_errList').addClass('alert alert-danger');
                    $.each(response.errors, function (key, err_values) { 
                      $('#updateform_errList').append('<li>'+err_values+'</li>');
                    }); 
                    $(".update_note").prop('disabled', false);            
                  } 
                  else if(response.status == 404) 
                  {
                    $('#updateform_errList').html("");
                    $('#success_message').addClass('alert alert-danger');
                    $('#success_message').text(response.message);
                    $(".update_note").prop('disabled', false);
                  } 
                  else
                  {
                    $('#updateform_errList').html("");
                    $('#success_message').html("");
                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    $('#EditNoteModal').modal('hide');
                    $('#FetchNotes').html("");
                    fetchAllNotes();
                    setTimeout(closeSuccess, 3000);
                  }
                }
            });   

        });

        $(document).on('click', '.edit_note', function (e) {
            e.preventDefault();

            var id = $(this).attr('value');

            $.ajax({
                type: "GET",
                url: "/edit-note/"+id,
                success: function (response) {
                  console.log(response);
                  if (response.status == 404) 
                  {
                    $('#success_message').html("");
                    $('#success_message').addClass('alert alert-danger');
                    $('#success_message').text(response.message);
                    setTimeout(closeSuccess, 3000);
                  } 
                  else 
                  {
                    $('#updateform_errList').html("");
                    $('#updateform_errList').removeClass();
                    $('#EditNoteModal').modal('show');
                    
                    $('#edit_note_id').val(response.note.id);
                    $('#edit_note_photo').html("");
                    $('#edit_note_image').val("");
                    if(response.note.photo){
                      $('#edit_note_photo').html(`<img id="edit_note_photo_preview" src="${response.note.photo}" class="card-img shadow-sm" alt="...">`);
                      $('#edit_note_photo').append(`
                        <div id="edit_note_delete_img" class="delete_img_btn">
                          <img class="icon-sm" src="/img/delete-light.png" alt="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Удалить фото">
                        </div>`);
                    }
                    $('#edit_note_title').html(response.note.title);
                    $('#edit_note_subtitle').html(response.note.subtitle);
                    $("#edit_note_content").html(response.note.content);
                    $('#edit_note_archive').html("");
                    if(response.note.archived == 1){
                      $('#edit_note_archive').append(`
                        <img id="edit_note_archive_active" class="icon me-3" src="/img/archive.png" alt="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Разархивировать">
                      `);
                    } else {
                      $('#edit_note_archive').append(`
                      <img id="edit_note_archive_inactive" class="icon me-3" src="/img/archive-light.png" alt="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Разархивировать">
                      `);
                    }
                    $('#EditNoteFetchTags').html("");
                    EditNotefetchAllTags();

                    $( document ).ajaxComplete(function() {
                      $('#EditNoteFetchTags input:checkbox').each(function() {
                      $(this).prop('checked', false);
                        var check = '';
                        var id = $(this).val();
                        var check = $(this);
                        // console.log('input' + $(this).val());
                        $.each(response.note.tags, function (key, item) {
                          // console.log('item' + item.id);
                          if (id == item.id) { 
                            $(check).prop('checked', true);
                            // console.log(check);
                          }

                        });
                      });
                    });
                    
                    $(".update_note").prop('disabled', false);
                    $(".delete_note").prop('disabled', false);
                  }
                }
            });
        });

        $(document).on('click', '.add_note', function (e) {
            e.preventDefault();
            $(".add_note").prop('disabled', true);

            var archiveId = $('#add_note_archive_value').attr('value');

            var tags = [];
            $('#AddNoteFetchTags input:checkbox:checked').each(function() {
              tags.push($(this).val());
            });

            var formData = new FormData();

            formData.append('photo', $('#add_note_image')[0].files[0]);
            formData.append('title', $('#add_note_title').text());
            formData.append('subtitle', $('#add_note_subtitle').text());
            formData.append('content', $("#add_note_content").text());
            formData.append('tags', tags);
            formData.append('archive', archiveId);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "/add-note",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (response) {
                  console.log(response);
                    if(response.status == 400)
                    {
                        $('#saveform_errList').html("");
                        $('#saveform_errList').addClass('alert alert-danger');
                        $.each(response.errors, function (key, err_values) { 
                             $('#saveform_errList').append('<li>'+err_values+'</li>');
                        });
                        $(".add_note").prop('disabled', false);
                    } 
                    else 
                    {
                        $('#success_message').html("");
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#AddNoteModal').modal('hide');
                        $('#FetchNotes').html("");
                        fetchAllNotes();
                        setTimeout(closeSuccess, 3000);
                    }
                }
            });

        });

        $(document).on('click', '.add', function (e) {
        e.preventDefault();

          $('#saveform_errList').html("");
          $('#saveform_errList').removeClass();
          $('#add_note_photo').html("");
          $('#add_note_image').val("");
          // console.log($('#add_note_image')[0].files[0]);
          $('#add_note_title').html("");
          $('#add_note_subtitle').html("");
          $("#add_note_content").html("");
          $('#add_note_archive').append(`
            <img id="add_note_archive_inactive" class="icon" src="/img/archive-light.png" alt="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Разархивировать">
          `);
          $('#add_note_archive_value').val("0");
          $('#AddNoteFetchTags').html("");
          AddNotefetchAllTags();
          $(".add_note").prop('disabled', false); 
        });

        function fetchAllTags() 
        {
          $.ajax({
            type: "GET",
            url: "/fetch-all-tags",
            data: "json",
            success: function (response) {
              console.log(response);

              $('#FetchTags').append(
                '<li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#AddTagModal">Добавить</a></li>'
                );
             
                $.each(response.tags, function (key, item) { 
                
                   $('#FetchTags').append(
                    '<li class="dropdown-item align-items-center justify-content-between border-top notes_by_tag" value="'+item.id+'">\
                      <div class="rounded-circle tag-circle shadow-sm me-2 '+item.type+'"></div>\
                      <div class="dropdown-tag-text">'+item.name+'</div>\
                      <img class="icon-sm ms-2 edit_tag" value="'+item.id+'" src="/img/edit.png" alt="" data-bs-toggle="tooltip" data-bs-placement="right" title="Изменить">\
                    </li>'
                   );

                });
            }
          });

        }

        function fetchNotesByTag(id) 
        {
          $.ajax({
            type: "GET",
            url: "/fetch-notes-by-tag/"+id,
            data: "json",
            success: function (response) {
              console.log(response);

                $.each(response.notes, function (key, item) { 
                  let tagsDivs = '';
                  const renderTags = (tags) => {
                    tags.forEach((tag) => {
                      tagsDivs += `<div class="card-tag ${tag.tags_type.type} shadow-sm">${tag.name}</div>`;
                    });
                  };
                  renderTags(item.tags);
                                 
                   $('#FetchNotes').append(
                    `<div class="col-xxl-3 col-xl-4 col-md-6 col-sm-12 col-12 mb-4">
                      <div class="card rounded-3 shadow-sm edit_note" value="${item.id}">
                        <div class="card-body">
                          <h5 class="card-title">${item.title}</h5>
                          <h6 class="card-subtitle mb-2 text-muted">${item.subtitle}</h6>
                          <p class="card-text">${item.content}</p>
                        </div>
                        <div class="card-tag-list border-top">
                          ${tagsDivs}
                        </div>
                      </div>
                    </div>`
                   );

                });

            }
          });

        }

        function AddNotefetchAllTags() 
        {
          $.ajax({
            type: "GET",
            url: "/fetch-all-tags",
            data: "json",
            success: function (response) {
             
                $.each(response.tags, function (key, item) {                

                  $('#AddNoteFetchTags').append(
                    `<li class="dropdown-item align-items-center justify-content-between unclickable">
                      <div class="rounded-circle tag-circle shadow-sm me-2 ${item.type} unclickable"></div>
                      <div class="dropdown-tag-text">${item.name}</div>
                      <input class="form-check-input ms-2 mt-0" type="checkbox" value="${item.id}">
                    </li>`
                   );              

                });
            }
          });

        }

        function EditNotefetchAllTags() 
        {
          $.ajax({
            type: "GET",
            url: "/fetch-all-tags",
            data: "json",
            success: function (response) {

                $.each(response.tags, function (key, item) {                

                  $('#EditNoteFetchTags').append(
                    `<li class="dropdown-item align-items-center justify-content-between unclickable">
                      <div class="rounded-circle tag-circle shadow-sm me-2 ${item.type} unclickable"></div>
                      <div class="dropdown-tag-text">${item.name}</div>
                      <input class="form-check-input ms-2 mt-0" type="checkbox" value="${item.id}">
                    </li>`
                  );                

                });
            }
          });

        }

        function fetchTagsTypes() 
        {
          $.ajax({
            type: "GET",
            url: "/fetch-tags-types",
            data: "json",
            success: function (response) {
              console.log(response);
             
                $.each(response.tagsTypes, function (key, item) { 
                
                   $('#AddFetchTagsTypes').append(
                    '<li><a class="dropdown-item add_select_tags_types" value="'+item.id+'" type="'+item.type+'">\
                      <div class="card-tag shadow-sm '+item.type+'">Категория</div>\
                      </a></li>'
                   );

                   $('#EditFetchTagsTypes').append(
                    '<li><a class="dropdown-item edit_select_tags_types" value="'+item.id+'" type="'+item.type+'">\
                      <div class="card-tag shadow-sm '+item.type+'">Категория</div>\
                      </a></li>'
                   );

                });
            }
          });

        }

        $(document).on('click', '.add_select_tags_types', function (e) {
            e.preventDefault();
            
            var id = $(this).attr('value');
            var type = $(this).attr('type');

            $('#add_tag_type').val(id);
            $('#add_tag_circle').removeClass();
            $('#add_tag_circle').addClass('rounded-circle tag-circle shadow-sm ' + type);
        });

        $(document).on('click', '.edit_select_tags_types', function (e) {
            e.preventDefault();
            
            var id = $(this).attr('value');
            var type = $(this).attr('type');

            $('#edit_tag_type').val(id);
            $('#edit_tag_circle').removeClass();
            $('#edit_tag_circle').addClass('rounded-circle tag-circle shadow-sm ' + type);
        });

        $(document).on('click', '.delete_tag', function (e) {
          e.preventDefault();
          $(".delete_tag").prop('disabled', true);

          var id = $('#edit_tag_id').attr('value');

          $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

          $.ajax({
                type: "DELETE",
                url: "/delete-tag/"+id,
                success: function (response) {
                  $('#success_message').addClass('alert alert-success');
                  $('#success_message').text(response.message);
                  $('#EditTagModal').modal('hide');
                  $('#FetchNotes').html("");
                  fetchAllNotes();
                  $('#FetchTags').html("");
                  fetchAllTags();
                  setTimeout(closeSuccess, 3000);
                }
              });
        });

        $(document).on('click', '.update_tag', function (e) {
            e.preventDefault();
            $(".update_tag").prop('disabled', true);
            
            var id = $('#edit_tag_id').attr('value');
      
            var data = {
                'name': $('#edit_tag_name').text(), 
                'type': $('#edit_tag_type').attr('value'), 
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "PUT",
                url: "/update-tag/"+id,
                data: data,
                dataType: "json",
                success: function (response) {
                  if(response.status == 400) 
                  {
                    $('#updateform_errList').html("");
                    $('#updateform_errList').addClass('alert alert-danger');
                    $.each(response.errors, function (key, err_values) { 
                      $('#updateform_errList').append('<li>'+err_values+'</li>');
                    }); 
                    $(".update_tag").prop('disabled', false);            
                  } 
                  else if(response.status == 404) 
                  {
                    $('#updateform_errList').html("");
                    $('#success_message').addClass('alert alert-danger');
                    $('#success_message').text(response.message);
                    $(".update_tag").prop('disabled', false);
                  } 
                  else
                  {
                    $('#updateform_errList').html("");
                    $('#success_message').html("");
                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    $('#EditTagModal').modal('hide');
                    $('#FetchNotes').html("");
                    fetchAllNotes();
                    $('#FetchTags').html("");
                    fetchAllTags();
                    setTimeout(closeSuccess, 3000);
                  }
                }
            });   

        });

        $(document).on('click', '.edit_tag', function (e) {
            e.preventDefault();
            e.stopPropagation();

            var id = $(this).attr('value');

            $.ajax({
                type: "GET",
                url: "/edit-tag/"+id,
                success: function (response) {
                  console.log(response);
                  if (response.status == 404) 
                  {
                    $('#success_message').html("");
                    $('#success_message').addClass('alert alert-danger');
                    $('#success_message').text(response.message);
                    setTimeout(closeSuccess, 3000);
                  } 
                  else 
                  {
                    $('#updateform_errList').html("");
                    $('#updateform_errList').removeClass();
                    $('#EditTagModal').modal('show');
                    $('#edit_tag_id').val(response.tag.id);
                    $('#edit_tag_type').val(response.type.id);
                    $('#edit_tag_name').html(response.tag.name);
                    $('#edit_tag_circle').removeClass();
                    $('#edit_tag_circle').addClass('rounded-circle tag-circle shadow-sm ' + response.type.type);
                    $(".update_tag").prop('disabled', false);
                    $(".delete_tag").prop('disabled', false);
                  }
                }
            });
        });

        $(document).on('click', '.add_tag', function (e) {
            e.preventDefault();
            $(".add_tag").prop('disabled', true);
            // var id = $('#add_tag_type').attr('value');
            // console.log(id);
            var data = {
                'name': $('#add_tag_name').text(),
                'type': $('#add_tag_type').attr('value'),
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "/add-tag",
                data: data,
                dataType: "json",
                success: function (response) {
                    if(response.status == 400)
                    {
                        $('#saveform_errList').html("");
                        $('#saveform_errList').addClass('alert alert-danger');
                        $.each(response.errors, function (key, err_values) { 
                             $('#saveform_errList').append('<li>'+err_values+'</li>');
                        });
                        $(".add_tag").prop('disabled', false);
                    } 
                    else 
                    {
                        $('#success_message').html("");
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#AddTagModal').modal('hide');
                        $('#FetchTags').html("");
                        fetchAllTags();
                        setTimeout(closeSuccess, 3000);
                    }
                }
            });

        });

        $(document).on('click', '.tags', function (e) {
        e.preventDefault();
          $('#saveform_errList').html("");
          $('#saveform_errList').removeClass();
          $('#add_tag_name').html("");
          $(".add_tag").prop('disabled', false); 
        });





      });

      function strip(html){
        let doc = new DOMParser().parseFromString(html, 'text/html');
        return doc.body.textContent || "";
      }

      function closeSuccess() 
      {
        $('#success_message').html("");
        $('#success_message').removeClass();
      }
  </script>

@endsection

    {{-- <!-- Authentication -->
    <form method="POST" action="{{ route('logout') }}">
      @csrf

      <a href="route('logout')"
              onclick="event.preventDefault();
                          this.closest('form').submit();">
          <img src="/img/logout.png" class="navbar-item" alt="">
      </a>
    </form>

    <form method="POST" action="{{ route('logout') }}">
      @csrf

      <div class="btn btn-primary" href="route('logout')"
              onclick="event.preventDefault();
                          this.closest('form').submit();">
          {{ __('Log Out') }}
      </div>
    </form> --}}

            {{-- <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddNoteModal">
              Add
            </button> --}}


            {{-- //     $.each(response.notes, function (key, item) { 
                
              //     $('#FetchNotes').append(
              //      '<div class="col-xxl-3 col-xl-4 col-md-6 col-sm-12 col-12 mb-4">\
              //        <div class="card rounded-3 shadow-sm edit_note" value="'+item.id+'">\
              //          <div class="card-body">\
              //            <h5 class="card-title">'+item.title+'</h5>\
              //            <h6 class="card-subtitle mb-2 text-muted">'+item.subtitle+'</h6>\
              //            <p class="card-text">'+item.content+'</p>\
              //          </div>\
              //          <div class="card-tag-list border-top">\
              //            '+$.each(response.notes, function (key, item) {+'\
              //                <div class="card-tag tag-red shadow-sm">123</div>\
              //            '+});+'\
              //          </div>\
              //        </div>\
              //      </div>'
              //     );
  
              //  }); --}}