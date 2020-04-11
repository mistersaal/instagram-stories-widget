@extends('errors::minimal')

@section('title', 'Unprocessable Entity')
@section('code', '422')
@section('message', __($exception->getMessage() ?: 'Unprocessable Entity'))
