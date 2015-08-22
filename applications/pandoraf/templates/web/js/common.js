(function($){
	var $popup_msg, $popup_msg_title, $popup_msg_content, $popup_msg_message, popup_msg_pos;
	$.pfmsgBox = {
			verticalOffset: -75,                // 垂直位移px
			horizontalOffset: 0,                // 水平位移px
			repositionOnResize: true,           // 屏幕缩放是否执行重定位
			overlayOpacity: .55,                // 背景层透明度
			overlayColor: '#000000',               // 背景层颜色
			dialogClass: null,                  // 自定义样式标签
			alertTitle: 'Alert',
			confirmTitle: 'Confirm',
			promptTitle: 'Prompt',
			
			ajaxload: function(message, title) {
				if( title == null ) title = $.pfmsgBox.alertTitle;
				$.pfmsgBox._show(title, message, null, 'ajaxload');
			},
			gethtml: function(message, title, ok, cancel, callback) {
				if( title == null ) title = $.pfmsgBox.alertTitle;
				$.pfmsgBox._show(title, message, null, 'html', ok, cancel, function(result) {
					if( callback ) callback(result);
				});
			},
			alert: function(message, title, ok, cancel, callback) {
				if( title == null ) title = $.pfmsgBox.alertTitle;
				$.pfmsgBox._show(title, message, null, 'alert', ok, cancel, function(result) {
					if( callback ) callback(result);
				});
			},
			confirm: function(message, title, ok, cancel, callback) {
				if( title == null ) title = $.pfmsgBox.confirmTitle;
				$.pfmsgBox._show(title, message, null, 'confirm', ok, cancel, function(result) {
					if( callback ) callback(result);
				});
			},
			prompt: function(message, value, title, ok, cancel, callback) {
				if( title == null ) title = $.pfmsgBox.promptTitle;
				$.pfmsgBox._show(title, message, value, 'prompt', ok, cancel, function(result) {
					if( callback ) callback(result);
				});
			},
              _show: function(title, msg, value, type, ok, cancel, callback) {
				
				$.pfmsgBox._hide();
				$.pfmsgBox._overlay('show');
				
				var css_name = '';
				var title_h1 = '<h1 class="popup_msg_title"></h1>';
				if(title=='none'){
					css_name = 'border';
					title_h1 = '';
				}
				
				$("body").append(
				'<div class="popup_msg '+css_name+'">' +
					title_h1 +
					'<div class="popup_msg_content">' +
					  '<div class="popup_msg_message"></div>' +
					'</div>' +
				'</div>');
				
				$popup_msg = $(".popup_msg");
				$popup_msg_title = $(".popup_msg .popup_msg_title");
				$popup_msg_content = $(".popup_msg .popup_msg_content");
				$popup_msg_message = $(".popup_msg .popup_msg_message");
				
				if( $.pfmsgBox.dialogClass ) $popup_msg.addClass($.pfmsgBox.dialogClass);
				
				// IE6 Fix
				var popup_msg_pos = ('undefined' == typeof(document.body.style.maxHeight)) ? 'absolute' : 'fixed'; 
				
				$popup_msg.css({
					position: popup_msg_pos,
					zIndex: 99999,
					padding: 0,
					margin: 0
				});
				
				if(title !='none'){
					$popup_msg_title.html(title);
					if(type != 'ajaxload'){
						$popup_msg_title.append('<s onclick="$.pfmsgBox._hide();"></s>');
					}
				}
				$popup_msg_content.addClass(type);
				if(type == 'html' || type == 'ajaxload'){
					$popup_msg_message.html(msg);	
				}else{
					$popup_msg_message.html('<div class="msg">'+ msg +'</div>');
				}

				$popup_msg.css({
					minWidth: $popup_msg_message.outerWidth(),
					maxWidth: $popup_msg_message.outerWidth()
				});
				
				if(type == 'ajaxload'){
					$popup_msg.html('<div class="loading"></div>');
				}
				
				$.pfmsgBox._reposition();
				$.pfmsgBox._maintainPosition(true);
				
				switch( type ) {
					case 'ajaxload':
						$(".popup_overlay").off("click.overlay");
					break;
					case 'html':
					break;
					case 'alert':
						if(ok!=''){
							$popup_msg_message.after('<div class="popup_msg_panel"><input type="button" value="' + ok + '" class="popup_btn_ok" /></div>');
						}
						$(".popup_btn_ok").click( function() {
							$.pfmsgBox._hide();
							callback(true);
						}).focus().keypress( function(e) {
							if( e.keyCode == 13 || e.keyCode == 27 ) $(".popup_btn_ok").trigger('click');
						});
					break;
					case 'confirm':
						$popup_msg_message.after('<div class="popup_msg_panel"><input type="button" value="' + ok + '" class="popup_btn_ok" /><input type="button" value="' + cancel + '" class="popup_btn_cancel" /></div>');
						$(".popup_btn_ok").click( function() {
							$.pfmsgBox._hide();
							if( callback ) callback(true);
						}).focus();
						$(".popup_btn_cancel").click( function() {
							$.pfmsgBox._hide();
							if( callback ) callback(false);
						});
						$(".popup_btn_ok, .popup_btn_cancel").keypress( function(e) {
							if( e.keyCode == 13 ) $(".popup_btn_ok").trigger('click');
							if( e.keyCode == 27 ) $(".popup_btn_cancel").trigger('click');
						});
					break;
					case 'prompt':
						$popup_msg_message.append('<br /><input type="text" size="30" class="popup_msg_prompt" />').after('<div class="popup_msg_panel"><input type="button" value="' + ok + '" class="popup_btn_ok" /> <input type="button" value="' + cancel + '" class="popup_btn_cancel" /></div>');
						$(".popup_msg_prompt").width( $popup_msg_message.width() );
						$(".popup_btn_ok").click( function() {
							$.pfmsgBox._hide();
							if( callback ) callback( $(".popup_msg_prompt").val() );
						});
						$(".popup_btn_cancel").click( function() {
							$.pfmsgBox._hide();
							if( callback ) callback( null );
						});
						$(".popup_msg_prompt, .popup_btn_ok, .popup_btn_cancel").keypress( function(e) {
							if( e.keyCode == 13 ) $(".popup_btn_ok").trigger('click');
							if( e.keyCode == 27 ) $(".popup_btn_cancel").trigger('click');
						});
						if( value ) $(".popup_msg_prompt").val(value);
						$(".popup_msg_prompt").focus().select();
					break;
				}
			},
			_hide: function() {
				$popup_msg && $popup_msg.remove();
				$.pfmsgBox._overlay('hide');
				$.pfmsgBox._maintainPosition(false);
			},
			
			_overlay: function(status) {
				switch( status ) {
					case 'show':
						$.pfmsgBox._overlay('hide');
						$("body").append('<div class="popup_overlay"></div>');
						$(".popup_overlay").css({
							position: 'absolute',
							zIndex: 99998,
							top: '0px',
							left: '0px',
							width: '100%',
							height: $(document).height(),
							background: $.pfmsgBox.overlayColor,
							opacity: $.pfmsgBox.overlayOpacity
						}).on('click.overlay',function(){
							$.pfmsgBox._hide();
						});
						
					break;
					case 'hide':
						$(".popup_overlay").remove();
					break;
				}
			},
			_reposition: function() {
				var top = (($(window).height() / 2) - ($popup_msg.outerHeight() / 2)) + $.pfmsgBox.verticalOffset;
				var left = (($(window).width() / 2) - ($popup_msg.outerWidth() / 2)) + $.pfmsgBox.horizontalOffset;
				if( top < 0 ) top = 50;
				if( left < 0 ) left = 0;
				
				// IE6 fix
				if('undefined' == typeof(document.body.style.maxHeight)) top = top + $(window).scrollTop();
				
				$popup_msg.css({
					top: top + 'px',
					left: left + 'px'
				});
				$(".popup_overlay").height( $(document).height() );
			},
			
			_maintainPosition: function(status) {
				if( $.pfmsgBox.repositionOnResize ) {
					switch(status) {
						case true:
							$(window).bind('resize', $.pfmsgBox._reposition);
						break;
						case false:
							$(window).unbind('resize', $.pfmsgBox._reposition);
						break;
					}
				}
			}
	}
	
	pfHtml = function(message, title, ok, cancel, callback) {
		$.pfmsgBox.gethtml(message, title, ok, cancel, callback);
	};
})(jQuery);
	
	/* ===========================================================
		多功能通用兼容移动端滑动切换功能
		
		startSlide (默认:0) - Swipe开始的索引
		speed (默认:300) - 前进和后退的速度，单位毫秒.
		auto (默认:0) 自动滑动ms 0为禁止
		tabClick (默认:false) 切换click/entermouse 
		resizeAuto (默认:false) 窗口拉动时是否重载
		continuous (默认:true) -是否可以循环播放（注：我设置为false好像也是循环的）
		disableScroll (默认:false) - 停止触摸滑动
		stopPropagation (默认:false) -停止事件传播
		callback - 回调函数，可以获取到滑动中图片的索引.
		transitionEnd - 在最后滑动结束后执行.
		window.mySwipe = $('').Swipe().data('Swipe');
		var banner = Swipe(
			$(".carouse_swipe")[0],{auto:4000,continuous:true,disableScroll:false,startSlide:0,callback: function(pos){console.log(pos)}
		});
		扩展 banner.next()
		$(".carouse_swipe").Swipe({auto:4000,continuous:true,disableScroll:false,startSlide:0,callback: function(pos){}});
	 * =========================================================== */
	
	;(function($) {
		$.fn.Swipe = function(params) {
		  return this.each(function() {
			$(this).data('Swipe', new Swipe($(this)[0], params));
		  });
		}
	})(jQuery)
	
	function Swipe(container, options) {
	
	  "use strict";//严格模式
	  if (!container) return;
	  
	  var noop = function() {}; 
	  var offloadFn = function(fn) { setTimeout(fn || noop, 0) };//将函数放在队列的最后执行
	  
	  // 检测浏览器功能
	  var browser = {
		addEventListener: !!window.addEventListener,
		touch: ('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch,
		transitions: (function(temp) {
		  var props = ['transitionProperty', 'WebkitTransition', 'MozTransition', 'OTransition', 'msTransition'];
		  for ( var i in props ) if (temp.style[ props[i] ] !== undefined) return true;
		  return false;
		})(document.createElement('swipe'))
	  };
	
	  var element = container.children[0].children[0];
	  var element_btn = container.children[1];
	  var element_tab = container.children[2];
	  var slides, slidePos, width, length;
	  options = options || {};
	  var index = parseInt(options.startSlide, 10) || 0;
	  var speed = options.speed || 300;
	  options.continuous = options.continuous !== undefined ? options.continuous : true;
	
	  function setup() {

		slides = element.children;//滚动元素
		length = slides.length;//滚动元素个数
	
		// 元素只有一个时禁用滚动
		if (slides.length < 2) options.continuous = false;
	
		//只有二个元素时的滚动
		if (browser.transitions && options.continuous && slides.length < 3) {
		  element.appendChild(slides[0].cloneNode(true));
		  element.appendChild(element.children[1].cloneNode(true));//克隆二个元素插入容器后面
		  slides = element.children;
		}
	
		width = container.getBoundingClientRect().width || container.offsetWidth;//容器宽度
		element.style.width = (slides.length * width) + 'px';//容器内元素宽度之和
	
		// 创建一个数组来保存滑块位置
		slidePos = new Array(slides.length);
		
		// 给每个元素定位
		var pos = slides.length;
		var slides_tab = '';
		while(pos--) {
			var slide = slides[pos];
			slide.style.width = width + 'px';//给每个子元素创建宽度样式
			slide.setAttribute('data-index', pos); //给每子个元素一个序号
			
			//如果支持滑动，给每个子元素添加css3滑动样式
			if (browser.transitions) {
				slide.style.left = (pos * -width) + 'px';
				move(pos, index > pos ? -width : (index < pos ? width : 0), 0);
			}
			//创建滑块tab
			slides_tab = slides_tab + "<li><i></i></li>"
		}
	
		$(element_tab).html(slides_tab).children().eq(index).addClass("active");
		imgload();
		
		// 重置默认开始显示元素之前和之后的参数
		if (options.continuous && browser.transitions) {
			move(circle(index-1), -width, 0);
			move(circle(index+1), width, 0);
		}
		
		//如果不支持滑动，给元素添加定位样式
		if (!browser.transitions) element.style.left = (index * -width) + 'px';
		
		//初始化完成后，设置容器为可见状态
		container.style.visibility = 'visible';
		
		//如果只有一个元素时，把翻页按钮设为隐藏状态
		if (slides.length < 2){
			element_btn.style.visibility = 'hidden';
			element_tab.style.visibility = 'hidden';
		}
	  }
	  
	  function prev() {
		if (options.continuous) slide(index-1);
		else if (index) slide(index-1);
	  }
	
	  function next() {
		if (options.continuous) slide(index+1);
		else if (index < slides.length - 1) slide(index+1);
	  }
	
	  function circle(index) {
		// a simple positive modulo using slides.length
		return (slides.length + (index % slides.length)) % slides.length;
	
	  }
	
	  function slide(to, slideSpeed) {
		// 如果已经滑动
		if (index == to) return;
		
		if (browser.transitions) {
	
		  var direction = Math.abs(index-to) / (index-to); // 1: 向左, -1: 向右
	
		  // 获取滑块的实际位置
		  if (options.continuous) {
			var natural_direction = direction;
			direction = -slidePos[circle(to)] / width;
	
			// if going forward but to < index, use to = slides.length + to
			// if going backward but to > index, use to = -slides.length + to
			if (direction !== natural_direction) to =  -direction * slides.length + to;
	
		  }
	
		  var diff = Math.abs(index-to) - 1;
	
		  // move all the slides between index and to in the right direction
		  while (diff--) move( circle((to > index ? to : index) - diff - 1), width * direction, 0);
				
		  to = circle(to);
	
		  move(index, width * direction, slideSpeed || speed);
		  move(to, 0, slideSpeed || speed);
	
		  if (options.continuous) move(circle(to - direction), -(width * direction), 0); // we need to get the next in place
		}
		else
		{     
		  //不支持transitions时使用animate
		  to = circle(to);
		  animate(index * -width, to * -width, slideSpeed || speed);
		}
	
		index = to;
		offloadFn(options.callback && options.callback(index, slides[index]));
	  }
	  
		//图片按需加载处理 
		function imgload(){
			$(element).children().eq(index).find("[data-src]").each(function(){
				var $this = $(this);						 
				$this.html('<img src="'+$this.attr("data-src")+'" alt="'+$this.attr("data-name")+'"/>').removeAttr("data-src");							  
			});
		}
	  
		function tabmove(){
			$(element_tab).children().eq(index).addClass("active").siblings().removeClass("active");
			imgload();
		}
	
		function move(index, dist, speed) {
		
			translate(index, dist, speed);
			slidePos[index] = dist;
		
		}
	
		function translate(index, dist, speed) {
		
			var slide = slides[index];
			var style = slide && slide.style;
			
			if (!style) return;
			
			style.webkitTransitionDuration = 
			style.MozTransitionDuration = 
			style.msTransitionDuration = 
			style.OTransitionDuration = 
			style.transitionDuration = speed + 'ms';
			
			style.webkitTransform = 'translate(' + dist + 'px,0)' + 'translateZ(0)';
			style.msTransform = 
			style.MozTransform = 
			style.OTransform = 'translateX(' + dist + 'px)';
		
		}
	
		function animate(from, to, speed) {
			
			// 如果不是动画，就复位
			if (!speed) {
			
			  element.style.left = to + 'px';
			  return;
			
			}
			
			var start = +new Date;
			
			var timer = setInterval(function() {
			  var timeElap = +new Date - start;
			  
			  if (timeElap > speed) {
			
				element.style.left = to + 'px';
			
				if (delay) begin();
			
				options.transitionEnd && options.transitionEnd.call(event, index, slides[index]);
			
				clearInterval(timer);
				return;
			
			  }
			
			element.style.left = (( (to - from) * (Math.floor((timeElap / speed) * 100) / 100) ) + from) + 'px';
			
			}, 4);
		
		}
	
		// 设置自动滚动
		var delay = options.auto || 0;
		var interval;
		
		function begin() {
			clear();
			interval = setTimeout(next, delay);
		}
		
		function clear() {
			clearTimeout(interval);
		}
		
		function stop() {
			delay = 0;
			clearTimeout(interval);
		}
		
		var start = {};
		var delta = {};
		var isScrolling;      
	
	  // 设置事件监听
	  var events = {
	
		handleEvent: function(event) {
	
		  switch (event.type) {
			case 'touchstart': this.start(event); break;
			case 'touchmove': this.move(event); break;
			case 'touchend': offloadFn(this.end(event)); break;
			case 'webkitTransitionEnd':
			case 'msTransitionEnd':
			case 'oTransitionEnd':
			case 'otransitionend':
			case 'transitionend': offloadFn(this.transitionEnd(event)); break;
			case 'resize': offloadFn(setup.call()); break;
		  }
	
		  if (options.stopPropagation) event.stopPropagation();
	
		},
		start: function(event) {
	
		  var touches = event.touches[0];
	
		  start = {
			x: touches.pageX,
			y: touches.pageY,
			time: +new Date
		  };
		  
		  isScrolling = undefined;
		  delta = {};
		  element.addEventListener('touchmove', this, false);
		  element.addEventListener('touchend', this, false);
	
		},
		move: function(event) {

		  if ( event.touches.length > 1 || event.scale && event.scale !== 1) return
		  if (options.disableScroll) event.preventDefault();
		  var touches = event.touches[0];
		  delta = {
			x: touches.pageX - start.x,
			y: touches.pageY - start.y
		  }
		  if ( typeof isScrolling == 'undefined') {
			isScrolling = !!( isScrolling || Math.abs(delta.x) < Math.abs(delta.y) );
		  }
		  if (!isScrolling) {
			event.preventDefault();
	
			// 停止延时自动滚动
			clear();
			if (options.continuous) {
	
			  translate(circle(index-1), delta.x + slidePos[circle(index-1)], 0);
			  translate(index, delta.x + slidePos[index], 0);
			  translate(circle(index+1), delta.x + slidePos[circle(index+1)], 0);
	
			} else {
	
			  delta.x = 
				delta.x / 
				  ( (!index && delta.x > 0               // if first slide and sliding left
					|| index == slides.length - 1        // or if last slide and sliding right
					&& delta.x < 0                       // and if sliding at all
				  ) ?                      
				  ( Math.abs(delta.x) / width + 1 )      // determine resistance level
				  : 1 );                                 // no resistance if false
			  
			  // translate 1:1
			  translate(index-1, delta.x + slidePos[index-1], 0);
			  translate(index, delta.x + slidePos[index], 0);
			  translate(index+1, delta.x + slidePos[index+1], 0);
			}
	
		  }
	
		},
		end: function(event) {
			
		  // measure duration
		  var duration = +new Date - start.time;
	
		  // determine if slide attempt triggers next/prev slide
		  var isValidSlide = 
				Number(duration) < 250               // if slide duration is less than 250ms
				&& Math.abs(delta.x) > 20            // and if slide amt is greater than 20px
				|| Math.abs(delta.x) > width/2;      // or if slide amt is greater than half the width
	
		  // determine if slide attempt is past start and end
		  var isPastBounds = 
				!index && delta.x > 0                            // if first slide and slide amt is greater than 0
				|| index == slides.length - 1 && delta.x < 0;    // or if last slide and slide amt is less than 0
	
		  if (options.continuous) isPastBounds = false;
		  
		  // determine direction of swipe (true:right, false:left)
		  var direction = delta.x < 0;
	
		  // if not scrolling vertically
		  if (!isScrolling) {
	
			if (isValidSlide && !isPastBounds) {
	
			  if (direction) {
	
				if (options.continuous) { // we need to get the next in this direction in place
	
				  move(circle(index-1), -width, 0);
				  move(circle(index+2), width, 0);
	
				} else {
				  move(index-1, -width, 0);
				}
	
				move(index, slidePos[index]-width, speed);
				move(circle(index+1), slidePos[circle(index+1)]-width, speed);
				index = circle(index+1);  
						  
			  } else {
				if (options.continuous) { // we need to get the next in this direction in place
	
				  move(circle(index+1), width, 0);
				  move(circle(index-2), -width, 0);
	
				} else {
				  move(index+1, width, 0);
				}
	
				move(index, slidePos[index]+width, speed);
				move(circle(index-1), slidePos[circle(index-1)]+width, speed);
				index = circle(index-1);
	
			  }
	
			  options.callback && options.callback(index, slides[index]);
	
			} else {
	
			  if (options.continuous) {
	
				move(circle(index-1), -width, speed);
				move(index, 0, speed);
				move(circle(index+1), width, speed);
	
			  } else {
	
				move(index-1, -width, speed);
				move(index, 0, speed);
				move(index+1, width, speed);
			  }
	
			}
	
		  }
		  
		  element.removeEventListener('touchmove', events, false)
		  element.removeEventListener('touchend', events, false)
	
		},
		transitionEnd: function(event) {
		  if (parseInt(event.target.getAttribute('data-index'), 10) == index) {
			if (delay) begin();
			options.transitionEnd && options.transitionEnd.call(event, index, slides[index]);
			tabmove();
		  }
		}
	  }
	
		// trigger setup
		setup();
		
		// 如果设置了auto大于0，开始自动滚动
		if (delay) begin();
		
		// 添加事件监听
		if (browser.addEventListener) {
		
			// 设置在元素上的触摸开始
			if (browser.touch) {
				element.addEventListener('touchstart', events, false);
			}
			if (browser.transitions) {
				element.addEventListener('webkitTransitionEnd', events, false);
				element.addEventListener('msTransitionEnd', events, false);
				element.addEventListener('oTransitionEnd', events, false);
				element.addEventListener('otransitionend', events, false);
				element.addEventListener('transitionend', events, false);
			}
			
			// 设置屏幕拉动事件
			if(options.resizeAuto) window.addEventListener('resize', events, false);
		} else {
		
			if(options.resizeAuto) window.onresize = function () { setup() }; //IE
		
		}
	  	// 设置自动滚动
		var tabClick = options.tabClick || false;
		var _tabClick = "mouseenter";
		tabClick && (_tabClick = "click");
		$(element_tab).on(_tabClick, "li", function(){
			clear();
			slide($(this).index());	
			if(delay) begin();
		});
		$(element_btn)
		.on("click", "li.prev", function(){
			clear();
			prev();
			if(delay) begin();
		})
		.on("click", "li.next", function(){
			clear();
			next();
			if(delay) begin();
		});
		
		
		// 暴露API
		return {
			setup: function() {
			  setup();
			},
			slide: function(to, speed) {      
			  clear();
			  slide(to, speed);
			  if(delay) begin();
			},
			prev: function() {
				clear();
				prev();
				if(delay) begin();
			},
			next: function() {
				clear();
				next();
				if(delay) begin();
			},
			getPos: function() {
			  // 获取当前元素的位置
			  return index;
			},
			getNumSlides: function() {
			  // 获取元素总个数
			  return length;
			},
			kill: function() {
			  stop();
			  // 重置元素样式
			  element.style.width = 'auto';
			  element.style.left = 0;
			  
			  var pos = slides.length;
			  while(pos--) {
				var slide = slides[pos];
				slide.style.width = '100%';
				slide.style.left = 0;
				if (browser.transitions) translate(pos, 0, 0);
			  }
			
			  // 移除绑定事件
			  if (browser.addEventListener) {
				element.removeEventListener('touchstart', events, false);
				element.removeEventListener('webkitTransitionEnd', events, false);
				element.removeEventListener('msTransitionEnd', events, false);
				element.removeEventListener('oTransitionEnd', events, false);
				element.removeEventListener('otransitionend', events, false);
				element.removeEventListener('transitionend', events, false);
				window.removeEventListener('resize', events, false);
			  }
			  else {
				window.onresize = null;
			  }
			
			}
	  }
	
	}
	
