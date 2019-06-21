package com.frost.attendance;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;

public class phpcodes extends AppCompatActivity {
    WebView webView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_phpcodes);
        webView=(WebView)findViewById(R.id.noticewebview2);
       WebSettings webSettings=webView.getSettings();
   webSettings.setJavaScriptEnabled(true);
      webView.loadUrl(Constants.URL_INDEX);
       // webView.loadUrl("https://www.google.com/");
        webView.setWebViewClient(new WebViewClient());
    }
    @Override
    public void onBackPressed() {
        if(webView.canGoBack())
        {
            webView.goBack();
        }
        else{
            super.onBackPressed();
        }

    }
}
