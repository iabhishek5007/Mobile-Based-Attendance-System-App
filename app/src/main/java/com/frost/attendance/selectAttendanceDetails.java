package com.frost.attendance;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.Spinner;

public class selectAttendanceDetails extends AppCompatActivity {

    Spinner spinnerselectsem, spinnerselectbranch, spinnerselectsection, spinnerselectsubject;
    DatePicker datePicker;
    Button btnsubmit;

    private String[] slectsemester = new String[]{"1", "2", "3", "4", "5", "6", "7", "8"};
    private String[] selectbranch = new String[]{"CSE", "IT"};
    private String[] selectsection = new String[]{"1", "2"};
    private String[] selectsubject = new String[]{"JAVA", "DBMS", "Networking", "C"};

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_select_attendance_details);

        spinnerselectsem = (Spinner) findViewById(R.id.spinnerselectsem);
        spinnerselectbranch = (Spinner) findViewById(R.id.spinnerselectbranch);
        spinnerselectsection = (Spinner) findViewById(R.id.spinnerselectsection);
        spinnerselectsubject = (Spinner) findViewById(R.id.spinnerselectsubject);

        datePicker = (DatePicker) findViewById(R.id.datepickker);

        btnsubmit =(Button) findViewById(R.id.btnsubmit);

        btnsubmit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent=new Intent(selectAttendanceDetails.this,phpcodes.class);
                startActivity(intent);
            }
        });

      spinnerselectsem.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
          @Override
          public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
              
          }

          @Override
          public void onNothingSelected(AdapterView<?> parent) {

          }
      });
    }
}
