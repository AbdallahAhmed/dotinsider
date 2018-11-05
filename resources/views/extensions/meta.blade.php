<?php $seo = $post->seo; ?>
<meta property="og:locale" content="{{app()->getLocale()}}"/>
<meta property="og:type" content="{{ $type or 'article'}}"/>
<meta name="author" content="{{option('site_name')}}">
<meta name="twitter:site" content="{{'@'.option('site_name')  }}">
<meta name="twitter:card" content="summary_large_image">
<meta property="og:url" content="{{$post->path}}">
<meta name="twitter:url" content="{{$post->path}}">

@if($seo&&!empty($seo))
    <!--seo Object-->
    <meta name="title" content="{{ $seo->meta_title or $post->title}}">
    <meta name="keywords" content="{{$seo->meta_keywords}}">
    <meta name="description" content="{{!empty($seo->meta_description)?$seo->meta_description:$post->excerpt}}"/>
    <meta property="og:title"
          content="{{ !empty($seo->facebook_title)?$seo->facebook_title:(!empty($seo->meta_title)? $seo->meta_title: $post->title)}}"/>
    <meta property="og:site_name" content="{{option('site_name')}}"/>
    <meta property="og:description"
          content="{{ !empty($seo->facebook_description)?$seo->facebook_description:(!empty($seo->meta_description)? $seo->meta_description: $post->excerpt)}}">
    <meta property="og:image"
          content="{{ !empty($seo->facebook)?uploads_url($seo->facebook->path):($post->image ? uploads_url($post->image->path) : '')}}">
    <meta name="twitter:title"
          content="{{!empty($seo->twitter_title)?$seo->twitter_title:(!empty($seo->meta_title)?$seo->meta_title: $post->title) }}">
    <meta name="twitter:description"
          content="{{ !empty( $seo->twitter_description)? $seo->twitter_description : ( !empty($seo->meta_description)?$seo->meta_description:$post->excerpt)}}">
    <meta name="twitter:image"
          content="{{ !empty($seo->twitter)?uploads_url($seo->twitter->path):($post->image ? uploads_url($post->image->path) : '')}}">
@else
    <!--not seo Object-->
    <meta name="title" content="{{ str_limit($post->title,60)}}">
    <meta name="description" content="{{ $post->excerpt}}"/>
    <meta property="og:locale" content="{{app()->getLocale()}}"/>
    <meta property="og:title" content="{{ $post->title}}"/>
    <meta property="og:site_name" content="{{option('site_name')}}"/>
    <meta property="og:description" content="{{ str_limit($post->excerpt,160,'')}}">
    <meta property="og:image" content="{{ ($post->image ? uploads_url($post->image->path) : '') }}">
    <meta name="twitter:title" content="{{$post->title }}">
    <meta name="twitter:description" content="{{ $post->excerpt}}">
    <meta name="twitter:image"
          content="{{ ($post->image ? uploads_url($post->image->path) : '') }}">
    <meta name="twitter:url" content="{{$post->path}}">
@endif