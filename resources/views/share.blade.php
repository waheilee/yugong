<script src="https://res.wx.qq.com/open/js/jweixin-1.4.0.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
    wx.config(<?php echo $skd; ?>);// 不用ECHO就会报APPID不合法

    wx.ready(function () {   //需在用户可能点击分享按钮前就先调用

        wx.updateAppMessageShareData({
            title: "{{$user['name']}}"+'正在分享', // 分享标题
            desc: '这是分享的描述', // 分享描述
            link: 'http://box.3wh.com/buy', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
            imgUrl: "{{$user['avatar']}}", // 分享图标
            success: function (res) {
            }
        })
    });
</script>