const { chromium } = require('playwright');
const fs = require('fs');
const path = require('path');

const BASE_URL = process.env.BASE_URL || process.argv[2] || 'http://app:8000';
const OUTPUT_DIR = path.resolve('/work/docs/screenshots');
const VIDEO_DIR = path.resolve('/work/docs');

if (!fs.existsSync(OUTPUT_DIR)) {
  fs.mkdirSync(OUTPUT_DIR, { recursive: true });
}

async function takeScreenshots() {
  console.log(`Starting automated screenshot capture at ${BASE_URL}...`);

  const browser = await chromium.launch({
    headless: true,
    args: ['--no-sandbox', '--disable-setuid-sandbox']
  });

  const context = await browser.newContext({
    viewport: { width: 1440, height: 900 },
    deviceScaleFactor: 1.5,
    recordVideo: {
      dir: VIDEO_DIR,
      size: { width: 1280, height: 720 },
    }
  });

  const page = await context.newPage();

  const goto = async (urlPath) => {
    await page.goto(`${BASE_URL}${urlPath}`, { waitUntil: 'networkidle' });
  };

  const capture = async (filename, fullPage = false) => {
    const dest = path.join(OUTPUT_DIR, filename);
    await page.screenshot({ path: dest, fullPage });
    console.log(`  ✓ Saved: docs/screenshots/${filename}`);
  };

  try {
    // 1. Login Page
    console.log('Capturing: 01-login.png');
    await goto('/login');
    await page.waitForTimeout(600);
    await capture('01-login.png');

    // 2. Register Page
    console.log('Capturing: 02-register.png');
    await goto('/register');
    await page.waitForTimeout(600);
    await capture('02-register.png');

    // 3. Login as Sarah Connor (Owner)
    console.log('Logging in as Sarah Connor (Colocation Owner)...');
    await goto('/login');
    await page.fill('input[type="email"], input[name="email"]', 'sarah@easycoloc.test');
    await page.fill('input[type="password"], input[name="password"]', 'password123');
    await page.click('button[type="submit"]');
    await page.waitForNavigation({ waitUntil: 'networkidle' }).catch(() => {});
    await page.waitForTimeout(1000);

    // 4. User Dashboard (Owner view)
    console.log('Capturing: 03-user-dashboard-owner.png');
    await goto('/user-dashboard');
    await page.waitForTimeout(1000);
    await capture('03-user-dashboard-owner.png', true);

    // 5. Open Add Expense Modal
    console.log('Capturing: 04-add-expense-modal.png');
    await page.evaluate(() => {
      const modal = document.getElementById('expenseModal');
      if (modal) modal.classList.remove('hidden');
    });
    await page.waitForTimeout(800);
    await capture('04-add-expense-modal.png');
    await page.evaluate(() => {
      const modal = document.getElementById('expenseModal');
      if (modal) modal.classList.add('hidden');
    });
    await page.waitForTimeout(500);

    // 6. Open Invite Form
    console.log('Capturing: 05-invite-member-form.png');
    await page.evaluate(() => {
      const form = document.getElementById('invite-form');
      if (form) form.classList.remove('hidden');
    });
    await page.waitForTimeout(800);
    await capture('05-invite-member-form.png');

    // 7. Colocations List
    console.log('Capturing: 06-colocations-list.png');
    await goto('/colocations');
    await page.waitForTimeout(800);
    await capture('06-colocations-list.png');

    // 8. Create Colocation Form
    console.log('Capturing: 07-create-colocation.png');
    await goto('/colocations/create');
    await page.waitForTimeout(800);
    await capture('07-create-colocation.png');

    // 9. Profile Page
    console.log('Capturing: 08-user-profile.png');
    await goto('/profile');
    await page.waitForTimeout(800);
    await capture('08-user-profile.png', true);

    // Clear session cookies for next user
    console.log('Switching session: Clearing cookies...');
    await context.clearCookies();

    // 10. Login as Alex Admin
    console.log('Logging in as Alex Admin (Global Admin)...');
    await goto('/login');
    await page.fill('input[type="email"], input[name="email"]', 'admin@easycoloc.test');
    await page.fill('input[type="password"], input[name="password"]', 'password123');
    await page.click('button[type="submit"]');
    await page.waitForNavigation({ waitUntil: 'networkidle' }).catch(() => {});
    await page.waitForTimeout(1000);

    // 11. Admin Dashboard
    console.log('Capturing: 09-admin-dashboard.png');
    await goto('/admin');
    await page.waitForTimeout(1000);
    await capture('09-admin-dashboard.png', true);

    // Clear session cookies for Member user
    console.log('Switching session: Clearing cookies...');
    await context.clearCookies();

    // 12. Login as John Doe (Regular Member)
    console.log('Logging in as John Doe (Colocation Member)...');
    await goto('/login');
    await page.fill('input[type="email"], input[name="email"]', 'john@easycoloc.test');
    await page.fill('input[type="password"], input[name="password"]', 'password123');
    await page.click('button[type="submit"]');
    await page.waitForNavigation({ waitUntil: 'networkidle' }).catch(() => {});
    await page.waitForTimeout(1000);

    // 13. Member User Dashboard
    console.log('Capturing: 10-user-dashboard-member.png');
    await goto('/user-dashboard');
    await page.waitForTimeout(1200);
    await capture('10-user-dashboard-member.png', true);

    console.log('All 10 screenshots captured successfully!');
  } catch (err) {
    console.error('Error during screenshot capture:', err);
    process.exitCode = 1;
  } finally {
    const video = await page.video();
    await context.close();
    await browser.close();

    if (video) {
      const videoPath = await video.path();
      const targetPath = path.join(VIDEO_DIR, 'demo.webm');
      if (fs.existsSync(videoPath)) {
        fs.renameSync(videoPath, targetPath);
        console.log(`  ✓ Demo video recorded: docs/demo.webm`);
      }
    }
  }
}

takeScreenshots();
