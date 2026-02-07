@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
  {{-- show success message --}}
  @if (session('message'))
    <div class="message success">{{ session('message') }}</div>
  @endif

  {{-- show error message raised by validation --}}
  @error('content')
    <div class="message failure">{{ $message }}</div>
  @enderror

  <div class="store-todo">
    <form action="{{ route('store') }}" method="post" class="store-todo__inner">
      @csrf
      <input type="text" name="content" class="store-todo__input">
      <button class="store-todo__button">作成</button>
    </form>
  </div>

  <div class="manage-todo">
    <table class="manage-todo__inner">
      <tr class="manage-todo__row">
        <th colspan=2 class="manage-todo__header">Todo</th>
      </tr>
      @foreach ($todos as $todo)
        <tr class="manage-todo__row">
          <td class="manage-todo__item">
            <form action="{{ route('update') }}" method="post" class="manage-todo__item-inner">
              @csrf
              @method('PATCH')

              <input type="text" name="content" value="{{ $todo->content }}" class="manage-todo__item-input">
              <input type="hidden" name="id" value="{{ $todo->id }}">
              <button class="manage-todo__button manage-todo__item-button">更新</button>
            </form>
          </td>
          <td class="manage-todo__delete">
            <form action="{{ route('destroy') }}" method="post">
              @csrf
              @method('DELETE')
              <input type="hidden" name="id" value="{{ $todo->id }}">
              <button class="manage-todo__button manage-todo__delete-button">削除</button>
            </form>
          </td>
        </tr>
      @endforeach
    </table>
  </div>
@endsection
