package com.frost.attendance;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class addfaculty extends AppCompatActivity {
    private EditText txtfacultyname, txtfacultyusername, txtfacultyemailid, txtmobileno, txtfacultyadd, txtfacultypass;
    private Button btnsubmit;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_addfaculty);

      /*  if(SharedPrefManager.getInstance(this).isLoggedIn()){
            finish();
            startActivity(new Intent(this, AdminLoginScreen.class));
            return;
        } */

        txtfacultyname = (EditText) findViewById(R.id.txtfacultyname);
        txtfacultyusername = (EditText) findViewById(R.id.txtfacultyusername);
        txtfacultyemailid = (EditText) findViewById(R.id.txtfacultyemailid);
        txtmobileno = (EditText) findViewById(R.id.txtmobileno);
        txtfacultyadd = (EditText) findViewById(R.id.txtfacultyadd);
        txtfacultypass = (EditText) findViewById(R.id.txtfacultypass);
        btnsubmit = (Button) findViewById(R.id.btnsubmit);
        btnsubmit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                registerfaculy();
             //  Toast.makeText(getApplicationContext(),"login success", Toast.LENGTH_LONG).show();
            }
        });
    }

    private void registerfaculy() {
        final String name = txtfacultyname.getText().toString().trim();
        final String username = txtfacultyusername.getText().toString().trim();
        final String email = txtfacultyemailid.getText().toString().trim();
        final String mobileno = txtmobileno.getText().toString().trim();
        final String address = txtfacultyadd.getText().toString().trim();
        final String password = txtfacultypass.getText().toString().trim();

        StringRequest stringRequest = new StringRequest(Request.Method.POST,
                Constants.URL_REGISTER,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        // progressDialog.dismiss();

                        try {
                            JSONObject jsonObject = new JSONObject(response);

                            Toast.makeText(getApplicationContext(), jsonObject.getString("message"), Toast.LENGTH_LONG).show();

                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        //  progressDialog.hide();
                        Toast.makeText(getApplicationContext(), error.getMessage(), Toast.LENGTH_LONG).show();
                    }
                }) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("name", name);
                params.put("username", username);
                params.put("password", password);
                params.put("email", email);
                params.put("address", address);
                params.put("mobileno", mobileno);
                return params;
            }
        };
        RequestHandler.getInstance(this).addToRequestQueue(stringRequest);

    }
}
