<style>
    .like-share-page {
        display: flex;
    }

    .zb-btn-blue-small {
        font-family: Helvetica, Arial, sans-serif;
        display: inline-block;
        background-color: #03a5fa;
        color: #fff;
        width: 70px;
        height: 20px;
        line-height: 21px;
        text-decoration: none;
        font-size: 11px;
        font-weight: bold;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        text-align: center;
        cursor: pointer;
        float: left;
        margin-left: 3px;
    }

    .zb-btn-blue-small .zb-logo-zalo {
        display: inline-block;
        vertical-align: middle;
        margin-bottom: 0.15em;
        margin-right: 4px;
        width: 14px;
        height: 14px;
        background: url(https://stc.sp.zdn.vn/share/logo_white_s.png);
    }
</style>

<div class="like-share-page mt-4">
    Chia sẻ:
    <div class="facebook">
        <div class="fb-like" data-href="<?= $url_page ?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
    </div>
    <div class="btnZalo zalo-share-button zb-btn-blue-small" data-href="<?= $url_page ?>" data-oaid="1563179794022425731" data-layout="icon-text" data-customize="true"><span class="zb-logo-zalo"></span><span class="label">Chia sẻ</span></div>
    <script src="https://sp.zalo.me/plugins/sdk.js" type="text/javascript" charset="utf-8"></script>
    <div class="google">
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <g:plusone size="medium"></g:plusone>
    </div>
</div>