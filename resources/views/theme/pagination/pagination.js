(function ($) {
    
    "use strict";

    
    $.fn.cPager = function (config) {
        var defaultConfig = {            
            pageSize: 8,
            pageCount: 1,
            pageIndex: 2,
            pageid: "pageing",
            total: 0,
            itemClass:"" 
        };
        
        var _config = $.extend({}, defaultConfig, config);

        
        this.Run = function (config) {            
            var C = this;  
                     
            this.show = function(){
              $("."+config.itemClass).hide();
              for(var i = 0;i<config.pageSize;i++)
              {
                $("."+config.itemClass).eq((config.pageIndex-1)*config.pageSize+i).show();            
              }
            };
            
            this.get = function () {
                var _inThis = this;  
               
                config.total = $("."+config.itemClass).length;
                           
                config.pageCount = parseInt(config.total / config.pageSize) + (config.total % config.pageSize > 0 ? 1 : 0);               
                
                this.show();  
                _inThis.createPage();
            },
            
           this.createPage = function () {
               if (config.total == 0) {
                   $("#" + config.showid).html("");
                   $("#" + config.pageid).css({"float":"none","text-align":"center"});
                   $("#" + config.pageid).html('<div class="loading">No Results</div>');
                   return;
               }else
               {
                  $("#" + config.pageid).css({"float":"right","text-align":"center"});
               }
               var html = '<div class="turn-num">'+config.total+' Entries, '+config.pageSize+' Entries Per Page</div>';
               html += '<ul class="turn-ul">';
               
               html += '<li class="tz first"><<</li>';
               if(config.pageIndex > 1)
                  html += '<li class="tz prev"><</li>';
               else
                  html += '<li class="tz prev"><</li>';

               
               if(config.pageIndex <= 6)
               {
                   if(config.pageCount <= 6)
                        for(var i = 1;i<=config.pageCount;i++)
                        {
                            if(i == config.pageIndex)
                                html +='<li class="on">' + i + '</li>';
                            else
                                html +='<li class="">' + i + '</li>';
                        }
                   else
                   {
                      
                       for(var i = 1;i<=6;i++)
                       {
                           if(i == config.pageIndex)
                               html +='<li class="on">' + i + '</li>';
                           else
                               html +='<li class="">' + i + '</li>';
                       }
                       html +='<i>...</i>';
                       html +='<li class="">' + config.pageCount + '</li>';
                   }
               }else if((config.pageIndex + 3) < config.pageCount)
               {
                   
                   
                   html +='<li class="">1</li>';
                   html +='<i>...</i>';
                   
                   for(var i = config.pageIndex-2;i<config.pageIndex+2;i++)
                   {
                       if(i == config.pageIndex)
                           html +='<li class="on">' + i + '</li>';
                       else
                           html +='<li class="">' + i + '</li>';
                   }
                   
                   html +='<i>...</i>';
                   html +='<li class="">' + config.pageCount + '</li>';
               }else
               {
                 
                   html +='<li class="">1</li>';
                   html +='<i>...</i>';
                  
                   for(var i = config.pageCount-4;i<=config.pageCount;i++)
                   {
                       if(i == config.pageIndex)
                           html +='<li class="on">' + i + '</li>';
                       else
                           html +='<li class="">' + i + '</li>';
                   }
               }
              
               
               if(config.pageIndex < config.pageCount)
                 html += '<li class="tz next">></li>';
               else
                 html += '<li class="tz next">></li>';

               html += '<li class="tz end">>></li>';                            

               $("#" + config.pageid).html(html);
               
               $("#"+config.pageid).attr("data-pagecount",config.pageCount);

               this.bindEvent();
            },
            
            this.bindEvent = function(){
              var _inThis = this;
              $("#"+config.pageid).find("ul li").click(function(){
                  var _curPage = $("#"+config.pageid).find("li.on").text()*1,
                      _totalPage = $("#"+config.pageid).data("pagecount");
                  
                  if($(this).attr('class').indexOf("first") > -1)
                  {
                    
                    config.pageIndex = 1;                   
                  }else if($(this).attr('class').indexOf("prev") > -1)
                  {
                    
                    if(_curPage > 1)
                      config.pageIndex--;
                  }else if($(this).attr('class').indexOf("next") > -1)
                  {
                    
                    if(_curPage < _totalPage)
                      config.pageIndex++;
                  }else if($(this).attr('class').indexOf("end") > -1)
                  {
                   
                    config.pageIndex = _totalPage;                  
                  }else if(!isNaN($(this).text()))
                  {
                    config.pageIndex = $(this).text()*1;
                  }
                  _inThis.show();
                  _inThis.createPage();                 
              }); 
            };
            
            this.init = function () {
                this.get();
            };

            this.init();
        };
        var C = this;
        
        return this.each(function () {
            _config.target = this;
            C.Run(_config);
        });
    };
})(jQuery);