<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>{{ $pageTitle }}</title>
</head>
<body>
    {{ $slot }}
</body>

<style>
  @page {
    margin: 6mm 12mm;
  }

  body {
    font-family: Arial, Helvetica, sans-serif;
    position: relative;
    box-sizing: content-box;
    padding: 20mm 0 10mm 0;
  }

  main {
    /* background-color: aqua */
    /* margin-top: 20mm; */
    /* margin-bottom: 15mm; */
  }

  h1 {
    text-align: center;
    font-size: 1.1rem;
    margin: 0;
  }

  h2 {
    font-size: 0.9rem;
    margin: 0;
  }

  h3 {
    font-size: 0.8rem;
    margin: 0;
  }

  p {
    line-height: 1rem;
    margin: 0;
    padding: 0;
  }

  table {
    border: 1px solid black;
    border-collapse: collapse;
  }

  div {
    box-sizing: border-box;
  }

  td {
    border: 1px solid black;
  }

  header {
    position: fixed;
    left: 0mm; top: 0mm; right: 0mm;
    margin: 0;
  }

  header p {
    text-align: center;
    margin: 0;
  }

  footer {
    position: fixed;
    left: 0mm; bottom: 0mm; right: 0mm;
    margin: 0;
  }

  hr {
    font-size: 10pt;
    border: 0.1mm solid black;
    margin: 0;
  }

  /* SEMANTIC CLASSES */

  .date-table {
    position: absolute;
    top: 28mm; right: 0;
    text-align: center;
  }

  .number-cell {
    padding: 0.2mm;
    margin: auto 0mm auto 0.5mm;
    border-bottom: 0.9px solid black;
    text-align: right;
  }

  .domicilio {
    position: absolute;
    z-index: 1;
    transform: rotate(-90deg);
    top: 8%;
    left: -5mm;
  }

  .paciente {
    position: absolute;
    z-index: 1;
    transform: rotate(-90deg);
    top: 30%;
    left: -5mm;
  }

  /* UTILITY CLASSES */

  .gray-background {
    background-color: gainsboro;
  }

  .dark-red-background {
    background-color: #913032;
  }

  .gray-text {
    color: rgb(100, 100, 100);
  }

  .black-background {
    background-color: black;
  }

  .blue-background {
    background-color: blue;
  }

  .text-white {
    color: white;
  }

  .p-6 {
    padding: 6mm;
  }

  .p-4 {
    padding: 4mm;
  }

  .p-3 {
    padding: 3mm;
  }

  .p-2 {
    padding: 2mm;
  }

  .p-1 {
    padding: 1mm;
  }

  .p-0 {
    padding: 0mm;
  }

  .px-1 {
    padding: auto 1mm;
  }

  .px-2 {
    padding: auto 2mm;
  }

  .px-8 {
    padding: auto 8mm;
  }

  .px-6 {
    padding: auto 6mm;
  }

  .px-5 {
    padding: auto 5mm;
  }

  .px-4 {
    padding: auto 4mm;
  }

  .pl-6 {
    padding-left: 6mm;
  }

  .pr-6 {
    padding-right: 6mm;
  }

  .py-2 {
    padding: 2mm auto;
  }

  .py-1 {
    padding: 1mm auto;
  }

  .pt-10 {
    padding-top: 10mm;
  }

  .pt-4 {
    padding-top: 4mm;
  }

  .pt-0 {
    padding-top: 0mm;
  }

  .pb-10 {
    padding-bottom: 10mm;
  }

  .bold {
    font-weight: bold;
  }

  .no-bold {
    font-weight: normal !important;
  }

  .italic {
    font-style: italic;
  }

  .m-0 {
    margin: 0;
  }

  .my-2 {
    margin: 2mm auto;
  }

  .mb-0 {
    margin-bottom: 0;
  }

  .mb-4 {
    margin-bottom: 4mm;
  }

  .mb-3 {
    margin-bottom: 3mm;
  }

  .mb-2 {
    margin-bottom: 2mm;
  }

  .mb-1 {
    margin-bottom: 1mm;
  }

  .mb-0 {
    margin-bottom: 0mm;
  }

  .mt-38 {
    margin-top: 38mm;
  }

  .mt-30 {
    margin-top: 30mm;
  }

  .mt-20 {
    margin-top: 20mm;
  }

  .mt-10 {
    margin-top: 10mm;
  }

  .mt-6 {
    margin-top: 6mm;
  }

  .mt-4 {
    margin-top: 4mm;
  }

  .mt-2 {
    margin-top: 2mm;
  }

  .mt-0 {
    margin-top: 0;
  }

  .mr-0 {
    margin-right: auto 0 auto auto;
  }

  .table-auto {
    table-layout: auto;
  }

  .table-fixed {
    table-layout: fixed;
  }

  .table-td-p-1 tr td {
    padding: 1mm;
  }

  .table-td-p-2 tr td {
    padding: 2mm;
  }

  .table-td-py-1 tr td {
    padding: 1mm 0;
  }

  .table-td-pl-1 tr td {
    padding-left: 1mm;
  }

  .table-td-border-none tr td {
    border: none;
  }

  .td-border-bottom {
    border-top: none;
    border-right: none;
    border-left: none;
    border-bottom: 1px solid black;
  }

  .w-f50 {
    width: 50%;
  }

  .w-full {
    width: 100%;
  }

  .w-fit {
    width: fit-content;
  }

  .w-90 {
    width: 90%;
  }

  .w-80 {
    width: 80%;
  }

  .w-70 {
    width: 70%;
  }

  .w-39 {
    width: 39%;
  }

  .w-38 {
    width: 38%;
  }

  .w-37 {
    width: 37%;
  }

  .w-36 {
    width: 36%;
  }

  .w-35 {
    width: 35%;
  }

  .w-34 {
    width: 34%;
  }

  .w-33 {
    width: 33%;
  }

  .w-32 {
    width: 32%;
  }

  .w-31 {
    width: 31%;
  }

  .w-30 {
    width: 30%;
  }

  .w-25 {
    width: 25%;
  }

  .w-24 {
    width: 24%;
  }

  .w-23 {
    width: 23%;
  }

  .w-22 {
    width: 22%;
  }

  .w-21 {
    width: 21%;
  }

  .w-20 {
    width: 20%;
  }

  .w-19 {
    width: 19%;
  }

  .w-18 {
    width: 18%;
  }

  .w-17 {
    width: 17%;
  }

  .w-16 {
    width: 16%;
  }

  .w-15 {
    width: 15%;
  }

  .w-14 {
    width: 14%;
  }

  .w-13 {
    width: 13%;
  }

  .w-12 {
    width: 12%;
  }

  .w-11-5 {
    width: 11.5%;
  }

  .w-11 {
    width: 11%;
  }

  .w-10 {
    width: 10%;
  }

  .w-9 {
    width: 9%;
  }

  .w-8 {
    width: 8%;
  }

  .w-7 {
    width: 7%;
  }

  .w-6 {
    width: 6%;
  }

  .w-5 {
    width: 5%;
  }

  .w-4 {
    width: 4%;
  }

  .w-3 {
    width: 3%;
  }

  .w-2 {
    width: 2%;
  }

  .w-1 {
    width: 1%;
  }

  .w-0 {
    width: 0%;
  }

  .h-full {
    height: full;
  }

  .h-f50 {
    height: 50%;
  }

  .h-15 {
    height: 15mm;
  }

  .h-20 {
    height: 20mm;
  }

  .h-10 {
    height: 10mm;
  }

  .h-5 {
    height: 5mm;
  }

  .h-3 {
    height: 3mm;
  }

  .h-2 {
    height: 2mm;
  }

  .font-12 {
    font-size: 12pt;
  }

  .font-11 {
    font-size: 11pt;
  }

  .font-10 {
    font-size: 10pt;
  }

  .font-9 {
    font-size: 9pt;
  }

  .font-8 {
    font-size: 8pt;
  }

  .font-7 {
    font-size: 7pt;
  }

  .font-6 {
    font-size: 6pt;
  }

  .font-5 {
    font-size: 5pt;
  }

  .line-6 {
    line-height: 6pt;
  }

  .line-5 {
    line-height: 5pt;
  }

  .text-center {
    text-align: center;
  }

  .text-right {
    text-align: right;
  }

  .text-left {
    text-align: left;
  }

  .text-justified {
    text-align: justify;
  }

  .text-bottom {
    vertical-align: bottom;
  }

  .red-text {
    color: red;
  }

  .br-0 {
    border-right: none;
  }

  .bl-0 {
    border-left: none;
  }

  .b-b-1 {
    border: 1px solid black !important;
  }

  .bb-b-1 {
    border-bottom: 1px solid black;
  }

  .brbl-b-1 {
    border-top: none;
    border-right: 1px solid black;
    border-bottom: 1px solid black;
    border-left: 1px solid black;
  }

  .bbl-b-1 {
    border-bottom: 1px solid black;
    border-left: 1px solid black;
    border-top: none;
    border-right: none;
  }

  .btbl-b-1 {
    border-top: 1px solid black;
    border-bottom: 1px solid black;
    border-left: 1px solid black;
    border-right: none;
  }

  .btrl-b-1 {
    border-top: 1px solid black;
    border-bottom: none;
    border-left: 1px solid black;
    border-right: 1px solid black;
  }

  .b-r-1 {
    border-right: 1px solid black;
    border-top: none;
    border-left: none;
    border-bottom: none;
  }

  .br-b-1 {
    border-top: none;
    border-right: 1px solid black;
    border-bottom: none;
    border-left: none;
  }

  .border-none {
    border: none;
  }

  .no-top-border {
    border-top: none;
  }

  .no-top-border-table {
    border-top: none;
  }

  .no-top-border-table tr td {
    border-top: none;
  }

  .corner-top-left-no-border {
    border-top: none;
    border-right: 1px solid black;
    border-bottom: 1px solid black;
    border-left: none;
  }

  .corner-top-right-no-border {
    border-top: none;
    border-right: none;
    border-bottom: 1px solid black;
    border-left: 1px solid black;
  }

  .corner-bottom-right-no-border {
    border-top: 1px solid black;
    border-right: none;
    border-bottom: none;
    border-left: 1px solid black;
  }

  .corner-bottom-left-no-border {
    border-top: 1px solid black;
    border-right: 1px solid black;
    border-bottom: none;
    border-left: none;
  }

  .no-top-border {
    border-top: none;
  }

  .no-bottom-border {
    border-bottom: none;
  }

  .inline {
    display: inline;
  }

  .inline-block {
    display: inline-block;
  }

  .uppercase {
    text-transform: uppercase;
  }

  .sentencecase {
    text-transform: capitalize;
  }

  .text-vertical {
    /* writing-mode: vertical-rl; */
    /* text-orientation: upright; */
    content: "";
    transform: rotate(-90deg);
    padding: 0mm;
    margin: 0mm;
    text-align:center;
    /* white-space:nowrap; */
    /* transform-origin:50% 50%; */
  }

  .float-right {
    float: right;
  }

  .relative {
    position: relative !important;
  }

  .page-break {
    page-break-after: always;
  }

  .whitespace-nowrap {
    white-space: nowrap;
  }

  .float-top {
    float: inline-start;
  }

  .v-start {
    vertical-align: baseline;
  }

  .vertical-text {
    position: absolute;
    z-index: 1;
    transform: rotate(-90deg);
  }

  .top-7 {
    top: 7%;
  }

  .top-6 {
    top: 6%;
  }

  .top-5 {
    top: 5%;
  }

  .top-4 {
    top: 4%;
  }

  .top-3-5 {
    top: 3.5%;
  }

  .top-3 {
    top: 3%;
  }

  .top-2 {
    top: 2%;
  }

  .-left-10 {
    left: -10mm;
  }

  .-left-9 {
    left: -9mm;
  }

  .-left-7 {
    left: -7mm;
  }

  .-left-6-5 {
    left: -6.5mm;
  }

  .-left-6 {
    left: -6mm;
  }

  .-left-5 {
    left: -5mm;
  }

  .-left-5-5 {
    left: -5.5mm;
  }

  .-left-4 {
    left: -4mm;
  }

  .-left-2 {
    left: -2mm;
  }

  .-left-1 {
    left: -1mm;
  }

  .table-fixed {
    table-layout: fixed;
  }
</style>
</html>