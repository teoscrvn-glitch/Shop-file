<?php
CheckLogin();
?>
<style>
    :root{
        --bg0:#070b14;
        --bg1:#0b1220;
        --card:rgba(255,255,255,.06);
        --card2:rgba(255,255,255,.08);
        --border:rgba(255,255,255,.12);
        --text:rgba(255,255,255,.92);
        --muted:rgba(255,255,255,.68);
        --shadow: 0 18px 55px rgba(0,0,0,.45);
        --radius:18px;

        --primary:#3b82f6;
        --primary2:#2563eb;
        --good:#22c55e;
        --danger:#ef4444;
        --warning:#f59e0b;

        --codeBg:#0b1220;
        --codeBorder:rgba(255,255,255,.10);
    }

    /* ===== Page background ===== */
    body{
        background:
            radial-gradient(900px 380px at 10% -10%, rgba(59,130,246,.28), transparent 55%),
            radial-gradient(820px 360px at 95% 0%, rgba(34,197,94,.18), transparent 60%),
            linear-gradient(180deg, var(--bg0), var(--bg1) 55%, #070a12);
        color: var(--text);
    }

    /* Bootstrap card override (nếu theme bạn đang dùng) */
    .card{
        background: transparent !important;
        border: 0 !important;
        box-shadow: none !important;
    }
    .card-body{
        background: transparent !important;
        color: var(--text) !important;
        padding: 0 !important;
    }

    /* ===== Layout ===== */
    .api-wrap{
        margin-top: 80px;
        padding-bottom: 28px;
    }
    .api-hero{
        position: relative;
        border-radius: var(--radius);
        padding: 22px 22px 18px;
        background: linear-gradient(180deg, rgba(255,255,255,.08), rgba(255,255,255,.04));
        border: 1px solid var(--border);
        box-shadow: var(--shadow);
        overflow: hidden;
    }
    .api-hero:before{
        content:"";
        position:absolute; inset:-2px;
        background:
            radial-gradient(520px 180px at 10% 10%, rgba(239,68,68,.18), transparent 60%),
            radial-gradient(520px 180px at 95% 0%, rgba(59,130,246,.22), transparent 62%);
        pointer-events:none;
        filter: blur(0.2px);
    }
    .api-hero > *{ position: relative; }

    .api-title{
        display:flex;
        align-items:center;
        gap:10px;
        margin:0;
        font-weight: 800;
        letter-spacing: .2px;
        font-size: 20px;
    }
    .api-sub{
        margin: 6px 0 0;
        color: var(--muted);
        font-size: 14px;
        line-height: 1.4;
    }

    .api-grid{
        display: grid;
        grid-template-columns: 1fr;
        gap: 14px;
        margin-top: 14px;
    }

    .api-card{
        border-radius: var(--radius);
        background: linear-gradient(180deg, rgba(255,255,255,.06), rgba(255,255,255,.04));
        border: 1px solid var(--border);
        box-shadow: 0 14px 45px rgba(0,0,0,.35);
        overflow: hidden;
    }
    .api-card__head{
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap: 10px;
        padding: 14px 16px;
        border-bottom: 1px solid rgba(255,255,255,.08);
        background: rgba(0,0,0,.12);
    }
    .api-card__title{
        display:flex;
        align-items:center;
        gap:10px;
        font-weight: 800;
        margin:0;
        font-size: 15px;
    }
    .api-card__body{
        padding: 14px 16px 16px;
    }

    .meta-row{
        display:flex;
        flex-wrap: wrap;
        gap:10px;
        margin-top: 6px;
        color: var(--muted);
        font-size: 13px;
    }
    .meta-pill{
        display:inline-flex;
        align-items:center;
        gap:8px;
        padding: 7px 10px;
        border-radius: 999px;
        background: rgba(255,255,255,.06);
        border: 1px solid rgba(255,255,255,.10);
    }
    .method{
        font-weight: 800;
        letter-spacing: .3px;
        padding: 4px 10px;
        border-radius: 999px;
        border: 1px solid rgba(255,255,255,.12);
        background: rgba(0,0,0,.2);
        color: var(--text);
    }
    .method.get{ border-color: rgba(59,130,246,.35); }
    .method.post{ border-color: rgba(239,68,68,.35); }

    /* ===== Key box ===== */
    .keybox{
        display:flex;
        gap:10px;
        align-items: stretch;
        margin-top: 14px;
    }
    .keybox .form-control{
        width: 100% !important;
        background: rgba(0,0,0,.25) !important;
        border: 1px solid rgba(255,255,255,.14) !important;
        color: var(--text) !important;
        border-radius: 14px !important;
        padding: 12px 12px !important;
        height: auto !important;
        outline: none !important;
        box-shadow: none !important;
    }
    .keybox .form-control:focus{
        border-color: rgba(59,130,246,.55) !important;
        box-shadow: 0 0 0 4px rgba(59,130,246,.15) !important;
    }

    .btnx{
        border: 0;
        border-radius: 14px;
        padding: 10px 12px;
        color: #fff;
        font-weight: 800;
        display:inline-flex;
        align-items:center;
        justify-content:center;
        gap:8px;
        cursor:pointer;
        transition: transform .12s ease, filter .12s ease, opacity .12s ease;
        white-space: nowrap;
        user-select:none;
    }
    .btnx:active{ transform: translateY(1px); }
    .btnx:hover{ filter: brightness(1.05); }
    .btnx.copy{ background: linear-gradient(180deg, var(--primary), var(--primary2)); }
    .btnx.rotate{ background: linear-gradient(180deg, #22c55e, #16a34a); }
    .btnx.small{ padding: 10px 14px; }

    /* ===== Code block (pre/code + hljs) ===== */
    pre{
        margin: 10px 0 0;
        background: var(--codeBg) !important;
        border: 1px solid var(--codeBorder) !important;
        border-radius: 16px !important;
        overflow: auto;
        padding: 12px 12px !important;
        box-shadow: inset 0 0 0 1px rgba(255,255,255,.03);
    }

    /* highlight.js classes (giữ nhưng đổi nền tối + chữ rõ) */
    .hljs{
        display:block;
        overflow-x:auto;
        padding: 0 !important;
        color: rgba(255,255,255,.92) !important;
        background: transparent !important;
        font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono","Courier New", monospace;
        font-size: 13px;
        line-height: 1.55;
    }
    .hljs-number{ color: #fbbf24 !important; }
    .hljs-attr{ color: #93c5fd !important; }
    .hljs-string{ color: #86efac !important; }
    .hljs-literal{ color: #fca5a5 !important; }
    .hljs-keyword{ color: #c4b5fd !important; }

    .muted{ color: var(--muted); }

    /* ===== Responsive ===== */
    @media (min-width: 992px){
        .api-grid{
            grid-template-columns: 1fr;
        }
        .api-title{ font-size: 22px; }
        .api-sub{ font-size: 14px; }
    }
    @media (max-width: 576px){
        .api-wrap{ margin-top: 70px; }
        .api-hero{ padding: 18px 14px 14px; }
        .api-card__head{ padding: 12px 12px; }
        .api-card__body{ padding: 12px 12px 14px; }
        .keybox{ flex-direction: column; }
        .btnx{ width: 100%; }
    }
</style>

<div class="container api-wrap">
    <!-- HERO: API KEY -->
    <div class="api-hero">
        <h2 class="api-title">
            <i class="fa fa-fw fa-share-alt" style="color: var(--danger)"></i>
            Cài đặt API
        </h2>
        <p class="api-sub">Kết nối với API thông qua API KEY của bạn.</p>

        <div class="keybox">
            <input type="text" id="copyNoiDung" class="form-control" value="<?=$getUser['token']?>" readonly>
            <button onclick="copy()" data-clipboard-target="#copyNoiDung" type="button" class="btnx copy small copy">
                <i class="fa fa-copy"></i> Copy
            </button>
            <button type="button" class="btnx rotate small" onclick="changekey()">
                <i class="fa fa-history"></i> Đổi API KEY
            </button>
        </div>
        <div class="meta-row" style="margin-top:12px">
            <span class="meta-pill"><i class="fa fa-shield"></i> <span>Giữ bí mật API KEY</span></span>
            <span class="meta-pill"><i class="fa fa-bolt"></i> <span>Hỗ trợ mobile / tablet / PC</span></span>
        </div>
    </div>

    <!-- API: BALANCE -->
    <div class="api-card" style="margin-top:15px">
        <div class="api-card__head">
            <h3 class="api-card__title">
                <i class="fa fa-fw fa-share-alt" style="color: var(--danger)"></i>
                API lấy số dư
            </h3>
            <span class="method post">POST</span>
        </div>
        <div class="api-card__body">
            <div class="meta-row">
                <span class="meta-pill"><b>API URL</b>: <span class="muted"><?=BASE_URL('')?>/api/v1/balance</span></span>
            </div>

            <p class="muted" style="margin:12px 0 6px">Body:</p>
            <pre><code class="json hljs">
{
  <span class="hljs-attr">"api_key"</span>: <span class="hljs-string">"API KEY"</span>
}
            </code></pre>

            <p class="muted" style="margin:12px 0 6px">Response:</p>
            <pre><code class="json hljs">
{
  <span class="hljs-attr">"status"</span>: <span class="hljs-literal">true</span>,
  <span class="hljs-attr">"balance"</span>: <span class="hljs-number">100000</span>,
  <span class="hljs-attr">"total_balance"</span>: <span class="hljs-number">100000</span>
}
            </code></pre>
        </div>
    </div>

    <!-- API: CATEGORIES -->
    <div class="api-card" style="margin-top:15px">
        <div class="api-card__head">
            <h3 class="api-card__title">
                <i class="fa fa-fw fa-share-alt" style="color: var(--danger)"></i>
                API lấy danh mục chính
            </h3>
            <span class="method get">GET</span>
        </div>
        <div class="api-card__body">
            <div class="meta-row">
                <span class="meta-pill"><b>API URL</b>: <span class="muted"><?=BASE_URL('')?>/api/v1/categories</span></span>
            </div>

            <p class="muted" style="margin:12px 0 6px">Response:</p>
            <pre><code class="json hljs">
{
  <span class="hljs-attr">"data"</span>: [
    {
      <span class="hljs-attr">"id"</span>: <span class="hljs-string">"1"</span>,
      <span class="hljs-attr">"stt"</span>: <span class="hljs-string">"1"</span>,
      <span class="hljs-attr">"name"</span>: <span class="hljs-string">"Hack Freefire"</span>,
      <span class="hljs-attr">"slug"</span>: <span class="hljs-string">"hack-freefire"</span>,
      <span class="hljs-attr">"images"</span>: <span class="hljs-string">"upload/product/productLPJ8BH.png"</span>,
      <span class="hljs-attr">"content"</span>: <span class="hljs-string">"Hack Freefire cho ios không cần jaibreak Và hack jaibreak"</span>,
      <span class="hljs-attr">"status"</span>: <span class="hljs-string">"1"</span>,
      <span class="hljs-attr">"create_date"</span>: <span class="hljs-string">"2022-12-27 15:43:51"</span>,
      <span class="hljs-attr">"update_date"</span>: <span class="hljs-string">"2023-02-09 13:34:04"</span>,
      <span class="hljs-attr">"list_groups"</span>: [
        {
          <span class="hljs-attr">"id"</span>: <span class="hljs-string">"1"</span>,
          <span class="hljs-attr">"name"</span>: <span class="hljs-string">"Hack Map"</span>,
          <span class="hljs-attr">"cate_id"</span>: <span class="hljs-string">"1"</span>,
          <span class="hljs-attr">"link_down"</span>: <span class="hljs-string">"https://www.facebook.com/nguyennhatloc"</span>,
          <span class="hljs-attr">"status"</span>: <span class="hljs-string">"1"</span>,
          <span class="hljs-attr">"create_date"</span>: <span class="hljs-string">"2022-12-27 16:12:18"</span>,
          <span class="hljs-attr">"update_date"</span>: <span class="hljs-string">"2023-02-12 22:21:36"</span>
        }
      ]
    }
  ]
}
            </code></pre>
        </div>
    </div>

    <!-- API: GROUP -->
    <div class="api-card" style="margin-top:15px">
        <div class="api-card__head">
            <h3 class="api-card__title">
                <i class="fa fa-fw fa-share-alt" style="color: var(--danger)"></i>
                API lấy danh sách sản phẩm
            </h3>
            <span class="method get">GET</span>
        </div>
        <div class="api-card__body">
            <div class="meta-row">
                <span class="meta-pill"><b>API URL</b>: <span class="muted"><?=BASE_URL('')?>/api/v1/group/1</span></span>
            </div>

            <p class="muted" style="margin:12px 0 6px">Response:</p>
            <pre><code class="json hljs">
{
  <span class="hljs-attr">"data"</span>: [
    {
      <span class="hljs-attr">"id"</span>: <span class="hljs-string">"1"</span>,
      <span class="hljs-attr">"name"</span>: <span class="hljs-string">"Hack Map"</span>,
      <span class="hljs-attr">"cate_id"</span>: <span class="hljs-string">"1"</span>,
      <span class="hljs-attr">"link_down"</span>: <span class="hljs-string">"https://www.facebook.com/nguyennhatloc"</span>,
      <span class="hljs-attr">"status"</span>: <span class="hljs-string">"1"</span>,
      <span class="hljs-attr">"create_date"</span>: <span class="hljs-string">"2022-12-27 16:12:18"</span>,
      <span class="hljs-attr">"update_date"</span>: <span class="hljs-string">"2023-02-12 22:21:36"</span>,
      <span class="hljs-attr">"list_package"</span>: [
        {
          <span class="hljs-attr">"id"</span>: <span class="hljs-string">"1"</span>,
          <span class="hljs-attr">"groups_id"</span>: <span class="hljs-string">"1"</span>,
          <span class="hljs-attr">"price"</span>: <span class="hljs-string">"5000"</span>,
          <span class="hljs-attr">"thoigian"</span>: <span class="hljs-string">"1"</span>,
          <span class="hljs-attr">"count"</span>: <span class="hljs-number">0</span>
        }
      ]
    }
  ]
}
            </code></pre>
        </div>
    </div>

    <!-- API: BUY -->
    <div class="api-card" style="margin-top:15px">
        <div class="api-card__head">
            <h3 class="api-card__title">
                <i class="fa fa-fw fa-share-alt" style="color: var(--danger)"></i>
                API Order
            </h3>
            <span class="method post">POST</span>
        </div>
        <div class="api-card__body">
            <div class="meta-row">
                <span class="meta-pill"><b>API URL</b>: <span class="muted"><?=BASE_URL('')?>/api/v1/buy</span></span>
            </div>

            <p class="muted" style="margin:12px 0 6px">Body:</p>
            <pre><code class="json hljs">
{
  <span class="hljs-attr">"api_key"</span>: <span class="hljs-string">"API KEY"</span>,
  <span class="hljs-attr">"id_group"</span>: <span class="hljs-number">1</span>,
  <span class="hljs-attr">"id_package"</span>: <span class="hljs-number">1</span>
}
            </code></pre>

            <p class="muted" style="margin:12px 0 6px">Response:</p>
            <pre><code class="json hljs">
{
  <span class="hljs-attr">"status"</span>: <span class="hljs-literal">true</span>,
  <span class="hljs-attr">"order_id"</span>: <span class="hljs-number">20</span>
}
            </code></pre>

            <h3 class="api-card__title" style="margin-top:14px; font-size:14px">
                <i class="fa fa-fw fa-code" style="color: var(--muted)"></i>
                Code demo PHP
            </h3>
            <pre><code class="php hljs">
$dataPost = [
  <span class="hljs-string">"api_key"</span> =&gt; <span class="hljs-string">"API_KEY"</span>,
  <span class="hljs-string">"id_product"</span> =&gt; <span class="hljs-number">1</span>,
  <span class="hljs-string">"id_package"</span> =&gt; <span class="hljs-number">1</span>,
];

$curl = curl_init();
curl_setopt_array($curl, <span class="hljs-keyword">array</span>(
  CURLOPT_URL =&gt; <span class="hljs-string">"<?=BASE_URL('')?>/api/v1/buy"</span>,
  CURLOPT_RETURNTRANSFER =&gt; <span class="hljs-keyword">true</span>,
  CURLOPT_ENCODING =&gt; <span class="hljs-string">""</span>,
  CURLOPT_MAXREDIRS =&gt; <span class="hljs-number">10</span>,
  CURLOPT_TIMEOUT =&gt; <span class="hljs-number">30</span>,
  CURLOPT_HTTP_VERSION =&gt; CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST =&gt; <span class="hljs-string">"POST"</span>,
  CURLOPT_POSTFIELDS =&gt; $dataPost,
));

$response = curl_exec($curl);
            </code></pre>
        </div>
    </div>

    <!-- API: ORDERS -->
    <div class="api-card" style="margin-top:15px">
        <div class="api-card__head">
            <h3 class="api-card__title">
                <i class="fa fa-fw fa-share-alt" style="color: var(--danger)"></i>
                API lấy danh sách orders
            </h3>
            <span class="method post">POST</span>
        </div>
        <div class="api-card__body">
            <div class="meta-row">
                <span class="meta-pill"><b>API URL</b>: <span class="muted"><?=BASE_URL('')?>/api/v1/orders</span></span>
            </div>

            <p class="muted" style="margin:12px 0 6px">Body:</p>
            <pre><code class="json hljs">
{
  <span class="hljs-attr">"api_key"</span>: <span class="hljs-string">"API KEY"</span>
}
            </code></pre>

            <p class="muted" style="margin:12px 0 6px">Response:</p>
            <pre><code class="json hljs">
{
  <span class="hljs-attr">"data"</span>: [
    {
      <span class="hljs-attr">"id"</span>: <span class="hljs-string">"26"</span>,
      <span class="hljs-attr">"user_id"</span>: <span class="hljs-string">"1"</span>,
      <span class="hljs-attr">"groups_name"</span>: <span class="hljs-string">"Hack Map"</span>,
      <span class="hljs-attr">"thoigian"</span>: <span class="hljs-string">"6"</span>,
      <span class="hljs-attr">"price"</span>: <span class="hljs-string">"13000"</span>,
      <span class="hljs-attr">"license"</span>: <span class="hljs-string">"adghsadshja9823"</span>,
      <span class="hljs-attr">"create_date"</span>: <span class="hljs-string">"2023-02-09 13:43:33"</span>,
      <span class="hljs-attr">"update_date"</span>: <span class="hljs-string">"2023-02-09 13:43:33"</span>
    }
  ]
}
            </code></pre>
        </div>
    </div>

    <!-- API: ORDER DETAIL -->
    <div class="api-card" style="margin-top:15px">
        <div class="api-card__head">
            <h3 class="api-card__title">
                <i class="fa fa-fw fa-share-alt" style="color: var(--danger)"></i>
                API xem chi tiết order
            </h3>
            <span class="method post">POST</span>
        </div>
        <div class="api-card__body">
            <div class="meta-row">
                <span class="meta-pill"><b>API URL</b>: <span class="muted"><?=BASE_URL('')?>/api/v1/order</span></span>
            </div>

            <p class="muted" style="margin:12px 0 6px">Body:</p>
            <pre><code class="json hljs">
{
  <span class="hljs-attr">"api_key"</span>: <span class="hljs-string">"API KEY"</span>,
  <span class="hljs-attr">"order_id"</span>: <span class="hljs-number">18</span>
}
            </code></pre>

            <p class="muted" style="margin:12px 0 6px">Response:</p>
            <pre><code class="json hljs">
{
  <span class="hljs-attr">"data"</span>: [
    {
      <span class="hljs-attr">"id"</span>: <span class="hljs-string">"26"</span>,
      <span class="hljs-attr">"user_id"</span>: <span class="hljs-string">"1"</span>,
      <span class="hljs-attr">"groups_name"</span>: <span class="hljs-string">"Hack Map"</span>,
      <span class="hljs-attr">"thoigian"</span>: <span class="hljs-string">"6"</span>,
      <span class="hljs-attr">"price"</span>: <span class="hljs-string">"13000"</span>,
      <span class="hljs-attr">"license"</span>: <span class="hljs-string">"adghsadshja9823"</span>,
      <span class="hljs-attr">"create_date"</span>: <span class="hljs-string">"2023-02-09 13:43:33"</span>,
      <span class="hljs-attr">"update_date"</span>: <span class="hljs-string">"2023-02-09 13:43:33"</span>
    }
  ]
}
            </code></pre>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>
<script>
    new ClipboardJS(".copy");
</script>
<script src="dist/js/sieuthicode.js?v=<?=time()?>"></script>