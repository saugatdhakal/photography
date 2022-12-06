import html2canvas from "html2canvas";
import pdfMake from "pdfmake/build/pdfmake";

// 72dpi
const RATE = 2.83464566929;

const PAGE_WIDTH = 500 * RATE;
const PAGE_HEIGHT = 500 * RATE;


const CONTENT_WIDTH = 500 * RATE;
const CONTENT_HEIGHT = 450 * RATE;
const PAGE_MARGINS = [0 * RATE, 0 * RATE];

/* for ts
interface PdfProps {
  dataUrl: string;
  pageSize?: {
    width: number;
    height: number;
  };
  pageOrientation?: string;
  contentSize?: {
    width: number;
    height: number;
  };
  pageMargins?: [number, number];
}
*/

/**
 * HTMLからPDFを生成
 * @param {HTMLElement} element
 */
export async function createPdfFromHtml(element) {
    const pdfProps = await createPdfProps(element);
    createPdf(pdfProps);
}

/**
 * @param {HTMLElement} element
 * @param {boolean} isOnlyQrCode
 * @returns {Promise<PdfProps>}
 */
async function createPdfProps(element) {
    // html2canvas
    const options = {
        scale: 2
    };
    const canvas = await html2canvas(element, options);

    const dataUrl = canvas.toDataURL();

    const pdfProps = {
        dataUrl,
        pageSize:{
            width:PAGE_WIDTH,
            height:PAGE_HEIGHT
        },
        pageOrientation: 'landscape',
        contentSize: {
            width: CONTENT_WIDTH,
            height: CONTENT_HEIGHT
        },
        pageMargins: PAGE_MARGINS
    };

    return pdfProps;
}

/**
 * @param {PdfProps} pdfProps
 */
function createPdf(pdfProps) {
    const { dataUrl, contentSize, pageMargins } = pdfProps;
    const pageSize = pdfProps.pageSize;
    const pageOrientation = pdfProps.pageOrientation;

    const documentDefinitions = {
        pageSize,
        pageOrientation,
        content: {
            image: dataUrl,
            ...contentSize
        },
        pageMargins
    };

    pdfMake.createPdf(documentDefinitions).download();
}
