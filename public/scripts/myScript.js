const observer = lozad('.lozad', {
    load: function(el) { // 生命周期：加载图片前
        el.src = el.getAttribute('data-src')
    },
    loaded: function (el) { // 加载完毕，实际图片还在pending中，页面还没显示图片
    }
})
observer.observe()