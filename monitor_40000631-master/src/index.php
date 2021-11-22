<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">

  <!-- Bootstrap CSS framework -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

  <!-- Favicon-->
  <link rel="icon" type="image" href="" alt="company-logo" />


  <!-- Font Awesome -->
  <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>

  <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

  <title>WebWordCount</title>
</head>

<body>

  <script type="text/javascript">

  let result = 0;
  let paragraph = '';
  let word = '';

  const proxyList = ["http://newproxy.40000631.qpc.hal.davecutting.uk", "http://newproxy2.40000631.qpc.hal.davecutting.uk", "http://newproxy3.40000631.qpc.hal.davecutting.uk"];

/* used for getting date - initally planned for use with storing logs
    function getDate() {

        var today = new Date();
        var dd = today.getDate();

        var mm = today.getMonth()+1;
        var yyyy = today.getFullYear();

        if(dd<10)
        {
            dd='0'+dd;
        }

        if(mm<10)
        {
            mm='0'+mm;
        }
        today = dd+'/'+mm+'/'+yyyy;

        $text = 'Logs for '
        document.getElementById('date').value = $text += today;
    }
*/

    // returns 1 of 5 words at random
    function generateWord() {

      const words = ['bookcase', 'shelf', 'pizza', 'fire', 'car'];

      var random = Math.floor(Math.random() * 5);
      var word = words[random];

      return word;

    }

    // returns 1 of 5 sentences at random
    function generateParagraph() {
      const paragraphs = ['The bookcase is in the library.', 'The shelf is in the kitchen.',
      'The pizza smells delicious.', 'The fire is so hot.', 'The car is really fast.']

      var random = Math.floor(Math.random() * 5);
      var paragraph = paragraphs[random];

      return paragraph;
    }

    // function for testing the performance, accuracy, test status and http status of the wordcount service
    function WordCount() {

        var a = performance.now();

        //paragraph = document.getElementById('paragraph-1').value;
        var paragraph = generateParagraph();

        var expectedWordCount = ' Expected : '
        var textCount = ' Actual : ';
        var pass = ' Test Status : Pass ';
        var fail = ' Test Status : Fail ';
        var count = 0;
        var proxyURL = proxyList[count];
        var HttpStatus = "";
        var expected = "";
        var arrayResult = "";

        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var HttpStatus = this.status.toString();
                document.getElementById('display-13').value = ' HTTP Status : '+ this.status;
                var j = JSON.parse(this.response);
                if (j.error != "") {
                  result = j.error;
                  document.getElementById('display-2').value = result;
                } else {
                  result = j.answer;
                  arrayResult = result.toString();
                  var expected = paragraph.trim().split(' ').length.toString();
                  document.getElementById('display-2').value = textCount += result;
                  document.getElementById('display-1').value = expectedWordCount += paragraph.trim().split(' ').length;
                  if(paragraph.trim().split(' ').length == result) {
                    document.getElementById('display-3').value = pass;
                  } else {
                    document.getElementById('display-3').value = fail;
                  }
                  var b = performance.now();
                  var c = b-a;
                  var perform = Math.round(c * 100 + Number.EPSILON) / 100;
                  document.getElementById('display-4').value = ' Performance : '+ perform + 'ms';
                }
            } else if (this.readyState == 4 && this.status != 200 && count <= proxyList.length) {
                document.getElementById('display-13').value = ' HTTP Status : '+ this.status;
                count+=1;
                proxyURL = proxyList[count];
                xhttp.open("GET",proxyURL+"?service=wordcount&paragraph="+paragraph);
                xhttp.send();
            }
          };

        xhttp.open("GET",proxyURL+"?service=wordcount&paragraph="+paragraph);
        xhttp.send();

        return;
    }

    // function for testing the performance, accuracy, test status and http status of the check service
    function KeyCheck() {

        //paragraph = document.getElementById('paragraph-2').value
        //word = document.getElementById('word-1').value

        var a = performance.now();

        var word = generateWord();
        var paragraph = generateParagraph();

        var expectedCheck = ' Expected : Exists ';
        var expectedCheckNot = ' Expected : Doesn\'t ';
        var textCheckPass = ' Actual : Exists ';
        var textCheckFail = ' Actual : Doesn\'t ';
        var pass = ' Test Status : Pass ';
        var fail = ' Test Status : Fail ';
        var count = 0;
        var proxyURL = proxyList[count];

        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('display-14').value = ' HTTP Status : '+ this.status;
                var j = JSON.parse(this.response);
                if (j.error != "") {
                  result = j.error;
                  document.getElementById('display-6').value = result;
                } else {
                  result = j.answer;
                  if(result == 1) {
                    document.getElementById('display-5').value = expectedCheck;
                    document.getElementById('display-6').value = textCheckPass;
                  } else {
                    document.getElementById('display-5').value = expectedCheckNot;
                    document.getElementById('display-6').value = textCheckFail;
                  }

                  if(paragraph.trim().split(' ').map(v => v.toLowerCase()).includes(word.toLowerCase()) && result == 1) {
                    document.getElementById('display-7').value = pass;
                  } else if(!paragraph.trim().split(' ').map(v => v.toLowerCase()).includes(word.toLowerCase()) && result == 0) {
                    document.getElementById('display-7').value = pass;
                  } else {
                    document.getElementById('display-7').value = fail;
                  }
                  var b = performance.now();
                  var c = b-a;
                  var perform = Math.round(c * 100 + Number.EPSILON) / 100;
                  document.getElementById('display-8').value = ' Performance : '+ perform + 'ms';
                }
            } else if (this.readyState == 4 && this.status != 200 && count <= proxyList.length) {
                document.getElementById('display-14').value = ' HTTP Status : '+ this.status;
                count+=1;
                proxyURL = proxyList[count];
                xhttp.open("GET",proxyURL+"?service=check&paragraph="+paragraph+"&word="+word);
                xhttp.send();
            }
          };

        xhttp.open("GET",proxyURL+"?service=check&paragraph="+paragraph+"&word="+word);
        xhttp.send();

        return;
    }

    // function for testing the performance, accuracy, test status and http status of the keywordcount service
    function KeywordCount() {

        //paragraph = document.getElementById('paragraph-3').value
        //word = document.getElementById('word-2').value

        var a = performance.now();

        paragraph = generateParagraph();
        word = generateWord();

        var expectedCount = ' Expected : '
        var keyCount = ' Actual : ';
        var pass = ' Test Status : Pass ';
        var fail = ' Test Status : Fail ';
        var count = 0;
        var proxyURL = proxyList[count];

        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('display-15').value = ' HTTP Status : '+ this.status;
                var j = JSON.parse(this.response);
                if (j.error != "") {
                  result = j.error;
                  document.getElementById('display-10').value = result;
                } else {
                  result = j.answer;
                  document.getElementById('display-10').value = keyCount += result;
                  var paragraphArray = paragraph.trim().split(' ').map(v => v.toLowerCase());
                  var keyNum = 0;
                  for (const element of paragraphArray) {
                    if (element == word.toLowerCase()) {
                      keyNum+=1;
                    }
                  }
                  document.getElementById('display-9').value = expectedCount += keyNum;
                  if(keyNum == result) {
                    document.getElementById('display-11').value = pass;
                  } else {
                    document.getElementById('display-11').value = fail;
                  }
                  var b = performance.now();
                  var c = b-a;
                  var perform = Math.round(c * 100 + Number.EPSILON) / 100;
                  document.getElementById('display-12').value = ' Performance : '+ perform + 'ms';
                }
            } else if (this.readyState == 4 && this.status != 200 && count <= proxyList.length) {
                document.getElementById('display-15').value = ' HTTP Status : '+ this.status;
                count+=1;
                proxyURL = proxyList[count];
                xhttp.open("GET",proxyURL+"?service=keywordcount&paragraph="+paragraph+"&word="+word);
                xhttp.send();
            }
          };

        xhttp.open("GET",proxyURL+"?service=keywordcount&paragraph="+paragraph+"&word="+word);
        xhttp.send();

        return;
    }

/*** Below are various attempts at writing the information to a csv file
*** It was decided using javascript for this was impractical though.
*** instead logs will be kept for the periodic monitoring service

    function writeToCSV() {

      csvRows = ["this","is","a","test"];

      var csvString = csvRows.join("%0A");
      var a = document.createElement('a');
      a.href = 'data:attachment/csv,' + csvString;
      a.target = '_blank';
      a.download = 'myFile.csv';
      document.body.appendChild(a);


        var fs = require('fs');
        var json2csv = require('json2csv');
        var newLine = '\r\n';

        var fields = ['example1', 'example2', 'example3', 'example4'];

        var append = [
          {
            example1: 'this',
            example2: 'is',
            example3: 'a',
            example4: 'test'
          },
        ];

        var toCsv = {
          data: append,
          fields: fields,
          header: false,
        };

        fs.stat('file.csv', function (err, stat) {
          if (err == null) {
            console.log('File exists');

            //write the actual data and end with newline
            var csv = json2csv(toCsv) + newLine;

            fs.appendFile('file.csv', csv, function (err) {
              if (err) throw err;
              console.log('The "data to append" was appended to file!');
            });
          } else {
            //write the headers and newline
            console.log('New file, just writing headers');
            fields = fields + newLine;

            fs.writeFile('file.csv', fields, function (err) {
              if (err) throw err;
              console.log('file saved');
            });
          }
        });

/*
      let csvContent = "data:text/csv;charset=utf-8,";


      data.forEach(function(rowArray) {
        let row = rowArray.join(',');
        csvContent += row + "\r\n";
      });

      var encodedUri = encodedUri(csvContent);
      window.open(encodedUri);

/*
      var csvContent = '';

      data.forEach(function(infoArray, index) {
          dataString = infoArray.join(",");
          csvContent += index < data.length ? dataString + '\n' : dataString;
      });

      var download = function(content, fileName, mimeType) {
        var a = document.createElement('a');
        mimeType = mimeType || 'application/octet-stream';

        if (navigator.msSaveBlob) {
          navigator.msSaveBlob(new Blob([content], {
            type: mimeType
          }), fileName);
        } else if (URL && 'download' in a) {
          a.href = URL.createObjectURL(new Blob([content], {
            type: mimeType
          }));
          a.setAttribute('download', fileName);
          document.body.appendChild(a);
          a.click();
          document.body.removeChile(a);
        } else {
          location.href = 'data:application/octet-stream,' + encodeURIComponent(content);
        }
      }

      download(csvContent, 'logs.csv', 'text/csv;encoding:utf-8');

    }
    */

  </script>

  <section id ='title'>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Web Word Count</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="http://newmonitor.40000631.qpc.hal.davecutting.uk/">Testing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://newdashboard.40000631.qpc.hal.davecutting.uk/">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://newdashboard.40000631.qpc.hal.davecutting.uk/#logs">Logs - Check</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://newdashboard.40000631.qpc.hal.davecutting.uk/#logs2">Logs - Wordcount</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://newdashboard.40000631.qpc.hal.davecutting.uk/#logs3">Logs - Keywordcount</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
  </section>

  <section id ='testing'>
    <div class="wordCount" style ="padding-left: 7%">
      <br>
      <h3>Service 1 : Word Count</h3>
      <hr style ="width: 80%; margin: auto">
      <br>
      <div class="container">
        <div class="row">
          <div class="col-2">
            <!--<textarea id="paragraph-1" style="width: 100%" rows="5" cols="35" placeholder="Enter the paragraph here..." value="">Enter the paragraph here...
            </textarea> -->
            <br>
            <div>
              <button type="button" class="btn btn-success" id="wordcountbtn" onclick="WordCount();">Run test</button>
            </div>
          </div>
          <div class="col-5">
            <input type="text" class="display" id="display-1" readonly=1 placeholder=" Expected : " value=""><br>
            <div>
              <input type="text" class="display" style="margin-top: 5px" id="display-2" readonly=1 placeholder=" Actual : " value=""><br>
            </div>
          </div>
          <div class="col-5">
            <input type="text" class="display" style="width: 185px" id="display-3" readonly=1 placeholder=" Test Status : " value=""><br>
            <div>
              <input type="text" class="display" style="margin-top: 5px; width: 185px" id="display-4" readonly=1 placeholder=" Performance : " value=""><br>
            </div>
            <div>
              <input type="text" class="display" style="margin-top: 5px; width: 185px" id="display-13" readonly=1 placeholder=" HTTP Status : " value=""><br>
            </div>
          </div>
        </div>
      </div>
      <br>
    </div>
    <div class="keyWord" style ="padding-left: 7%">
      <br>
      <h3>Service 2 : Check Keyword Appearance</h3>
      <hr style ="width: 80%; margin: auto">
      <br>
      <div class="container">
        <div class="row">
          <div class="col-2">
            <!--<textarea id="paragraph-2" style="width: 100%" rows="5" cols="35" placeholder="Enter the paragraph here..." value="">Enter the paragraph here...
            </textarea>
            <div>
                <input type="text" id="word-1" placeholder="Enter the keyword here..." value="">
            </div> -->
            <br>
            <div>
              <button type="button" class="btn btn-success" onclick="KeyCheck();">Run test</button>
            </div>
          </div>
          <div class="col-5">
            <input type="text" class="display" id="display-5" readonly=1 placeholder=" Expected : " value=""><br>
            <div>
              <input type="text" class="display" style="margin-top: 5px" id="display-6" readonly=1 placeholder=" Actual : " value=""><br>
            </div>
          </div>
          <div class="col-5">
            <input type="text" class="display" style="width: 185px" id="display-7" readonly=1 placeholder=" Test Status : " value=""><br>
            <div>
              <input type="text" class="display" style="margin-top: 5px; width: 185px" id="display-8" readonly=1 placeholder=" Performance : " value=""><br>
            </div>
            <div>
              <input type="text" class="display" style="margin-top: 5px; width: 185px" id="display-14" readonly=1 placeholder=" HTTP Status : " value=""><br>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="keyCount" style ="padding-left: 7%">
      <br>
      <h3>Service 3 : Total Keyword Appearances</h3>
      <hr style ="width: 80%; margin:auto">
      <br>
      <div class="container">
        <div class="row">
          <div class="col-2">
            <!-- <textarea id="paragraph-3" style="width: 100%" rows="5" cols="35" placeholder="Enter the paragraph here..." value="">Enter the paragraph here...
            </textarea>
            <div>
                <input type="text" id="word-2" placeholder="Enter the keyword here..." value="">
            </div> -->
            <br>
            <div>
              <button type="button" class="btn btn-success" onclick="KeywordCount();">Run test</button>
            </div>
            <br>
          </div>
          <div class="col-5">
            <input type="text" class="display" id="display-9" readonly=1 placeholder=" Expected : " value=""><br>
            <div>
              <input type="text" class="display" style="margin-top: 5px" id="display-10" readonly=1 placeholder=" Actual : " value=""><br>
            </div>
          </div>
          <div class="col-5">
            <input type="text" class="display" style="width: 185px" id="display-11" readonly=1 placeholder=" Test Status : " value=""><br>
            <div>
              <input type="text" class="display" style="margin-top: 5px; width: 185px" id="display-12" readonly=1 placeholder=" Performance : " value=""><br>
            </div>
            <div>
              <input type="text" class="display" style="margin-top: 5px; width: 185px" id="display-15" readonly=1 placeholder=" HTTP Status : " value=""><br>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>

</body>

</html>
