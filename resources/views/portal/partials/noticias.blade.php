@if(count($news) != 2)
<div class="row" style="display: flex;">
                  <div class="col-sm-12 col-md-8" style="margin-bottom: 10px; border-right: 1px solid #ddd; flex: 2;">
                  <div class="nttexto">
                    <h2>{{ $news[0]->title }}</h2>
                    {!! str_limit($news[0]->text, 120) !!}
                    <br><br>
                  </div>
                    <button class="btn btn-default center-block" onclick="window.location.href='{{ route('notícia', $news[0]->id) }}'">@lang('messages.layout.readmore')</button>
                  </div>
                  <div class="col col-sm-12 col-md-4 text-center" style="flex: 1;">
                  <div class="col-sm-6 col-md-12">
                    <a href="#"><img src="//placehold.it/300x120/77CCDD/66BBCC" class="center-block img-responsive"></a>
                    <div class="text-muted"><small>{{ str_limit($news[1]->title, 50) }}</small></div>
                    <p>
                    <div class="nttexto">
                   {!! str_limit($news[1]->subtitle, 60) !!}
                    </div>
                    </p>
                  </div>
                  <div class="col-sm-6 col-md-12">
                    <a href="#"><img src="//placehold.it/300x120/77CCDD/66BBCC" class="center-block img-responsive"></a>
                    <div class="text-muted"><small>{{ str_limit($news[2]->title, 50) }}</small></div>
                    <p>
                    <div class="nttexto">
                    {!! str_limit($news[2]->subtitle, 60) !!}
                    </div>
                    </p>
                  </div>
                  </div>   
                </div>
@else
<div class="row" style="display: flex;">
                  <div class="col-sm-12 col-md-8" style="margin-bottom: 10px; border-right: 1px solid #ddd; flex: 2;">
                    <h2>The Year of Responsive Design.</h2>
                    2013 was marked as the year of Responsive Web Design (RWD). The Web is filled with big brands, galleries and magical examples that media queries demonstrate the glory of responsive design.
                    <br><br>
                    <button class="btn btn-default center-block">More</button>
                  </div>
                  <div class="col col-sm-12 col-md-4 text-center" style="flex: 1;">
                  <div class="col-sm-6 col-md-12">
                    <a href="#"><img src="//placehold.it/300x120/77CCDD/66BBCC" class="center-block img-responsive"></a>
                    <div class="text-muted"><small>Aug 15 / John Pierce</small></div>
                    <p>
                    Web design has come a long way since 1999.
                    </p>
                  </div>
                  <div class="col-sm-6 col-md-12">
                    <a href="#"><img src="//placehold.it/300x120/77CCDD/66BBCC" class="center-block img-responsive"></a>
                    <div class="text-muted"><small>Aug 15 / Wilson Traiker</small></div>
                    <p>
                    The "flat" look was a big trend this year.
                    </p>
                  </div>
                  </div>   
                </div>
@endif