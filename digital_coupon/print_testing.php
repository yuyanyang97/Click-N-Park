<script type="text/javascript">
  function() {

  function imgToBase64(url, callback) {
    if (!window.FileReader) {
      callback(null);
      return;
    }
    var xhr = new XMLHttpRequest();
    xhr.responseType = 'blob';
    xhr.onload = function() {
      var reader = new FileReader();
      reader.onloadend = function() {
        callback(reader.result.replace('text/xml', 'image/jpeg'));
      };
      reader.readAsDataURL(xhr.response);
    };
    xhr.open('GET', url);
    xhr.send();
  }

  var base64Img;

  imgToBase64("https://placeholdit.imgix.net/~text?txtsize=6&txt=50%C3%9750&w=50&h=50", function(base64) {
    base64Img = base64;
  });

  var getColumns = function() {
    return [{
        title: "ID",
        dataKey: "id"
      },
      {
        title: "Name",
        dataKey: "name"
      }
    ];
  };

  var getData = function() {
    var i = 0,
      len = 50,
      arr = [];

    for (i, len; i < len; i++) {
      arr.push({
        id: i,
        name: "example"
      });
    }

    return arr;
  }

  function generate() {
    var doc = new jsPDF();
    var totalPagesExp = "{total_pages_count_string}";

    var pageContent = function(data) {
      // HEADER
      doc.setFontSize(20);
      doc.setTextColor(40);
      doc.setFontStyle('normal');
      if (base64Img) {
        doc.addImage(base64Img, 'JPEG', data.settings.margin.left, 15, 10, 10);
      }
      doc.text("Example", data.settings.margin.left + 15, 22);

      // FOOTER
      var str = "Page " + data.pageCount;
      // Total page number plugin only available in jspdf v1.0+
      if (typeof doc.putTotalPages === 'function') {
        str = str + " of " + totalPagesExp;
      }
      doc.setFontSize(10);
      doc.text(str, data.settings.margin.left, doc.internal.pageSize.height - 10);
    };

    doc.autoTable(getColumns(), getData(), {
      addPageContent: pageContent,
      margin: {
        top: 30
      }
    });

    // Total page number plugin only available in jspdf v1.0+
    if (typeof doc.putTotalPages === 'function') {
      doc.putTotalPages(totalPagesExp);
    }

    doc.save("headerandfooterexample.pdf");
  }

  document.getElementById('download-btn').addEventListener('click', generate);

})()
</script>